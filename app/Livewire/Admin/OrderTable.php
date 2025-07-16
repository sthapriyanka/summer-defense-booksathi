<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class OrderTable extends Component
{
    use WithPagination, Interactions;

    public $search = '';
    public $sortField = 'order_number';
    public $sortDirection = 'asc';

    public $paymentModal = false;

    public  $order_number, $payment_mode, $amount, $order_id, $user_id;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'title'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function approveOrder($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return $this->toast()->error('Order not found.');
        }

        $this->toast()->info('Opening modal for order #' . $order->order_number);
        $this->openPaymentModal($orderId); // only open the modal
    }

    public function rejectOrder($orderId)
    {
        $order = Order::with('orderItems')->find($orderId);

        if (!$order)
            return $this->toast()->error('Order not found.');

        $order->status = 'cancelled';
        $order->save();

        $this->toast()->error('Order has been rejected.');
    }

    public function openPaymentModal($orderId)
    {
        $this->paymentModal = true;
        $order = Order::findOrFail($orderId);

        $this->order_id = $order->id;
        $this->user_id = $order->user_id;
        $this->order_number = $order->order_number;
        $this->amount = $order->total_amount;
        $this->payment_mode = $order->payment_mode;
    }

    public function submitPayment()
    {
        $this->validate([
            'payment_mode' => 'required|string|in:cash,card,connectIPS',
        ]);

        DB::beginTransaction();
        try {
            Payment::create([
                'user_id' => $this->user_id,
                'order_id' => $this->order_id,
                'total_amount' => $this->amount,
                'paid_amount' => $this->amount, // full payment
                'paid_at' => now(),
                'payment_mode' => $this->payment_mode,
                'status' => 'paid',
                'fee_type' => 'rental', // hardcoded
            ]);

            // Confirm order and create rentals
            $order = Order::with('orderItems')->find($this->order_id);
            if ($order) {
                $order->status = 'confirmed';
                $order->save();

                foreach ($order->orderItems as $orderItem) {
                    Rental::create([
                        'user_id' => $order->user_id,
                        'book_id' => $orderItem->book_id,
                        'order_item_id' => $orderItem->id,
                        'rented_at' => now(),
                        'due_date' => now()->addWeeks($orderItem->rental_duration_weeks),
                        'status' => 'rented',
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        $this->paymentModal = false;
        $this->clearForm();

        $this->toast()->success('Payment recorded and order confirmed.');
        $this->redirect(route('admin.payments'));
    }



    public function clearForm()
    {
        $this->reset(['payment_mode', 'order_id', 'user_id', 'amount', 'order_number']);
        $this->resetErrorBag();
    }

    public function cancelPayment()
    {
        $this->paymentModal = false;
        $this->clearForm();
        $this->toast()->info('Payment cancelled. Order not confirmed.');
    }


    public function render()
    {
        $orderItems = OrderItems::with(['order.user', 'book'])
            ->whereHas('order', function ($query) {
                $query->where('order_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.order-table', compact('orderItems'));
    }
}
