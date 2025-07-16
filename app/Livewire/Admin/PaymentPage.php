<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use App\Models\Order;
use App\Traits\WithDataTable;
use Livewire\Attributes\Computed;
use TallStackUi\Traits\Interactions;

class PaymentPage extends Component
{
    use WithDataTable, Interactions;

    public $paymentModal = false;

    public $selectedPayment;

    public $order_id, $user_id, $order_number, $total_amount, $fine_amount, $due_amount, $paid_amount, $payment_mode, $fee_type;

    public $kpis = [];
    public $filters = [
        'type' => 'all'
    ];

    protected $listeners = [
        'paymentUpdated' => '$refresh',  // to refresh list after payment is submitted
    ];

    public function mount()
    {
        $this->loadKPIs();
    }

    public $headers = [
        ['index' => 'id', 'label' => 'Payment ID', 'sortable' => true],
        ['index' => 'name', 'label' => 'User Name', 'sortable' => false],
        ['index' => 'type', 'label' => 'Type', 'sortable' => true],
        ['index' => 'total_amount', 'label' => 'Amount (Rs.)', 'sortable' => true],
        ['index' => 'rental', 'label' => 'Rental Item', 'sortable' => false],
        ['index' => 'paid_at', 'label' => 'Payment Date', 'sortable' => true],
        ['index' => 'payment_mode', 'label' => 'Method', 'sortable' => true],
        ['index' => 'action', 'label' => 'Action', 'sortable' => false],
    ];

    public function loadKPIs()
    {
        $now = now();
        $startOfThisMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        $thisMonthTotal = Payment::whereBetween('paid_at', [$startOfThisMonth, $now])->sum('paid_amount');
        $lastMonthTotal = Payment::whereBetween('paid_at', [$startOfLastMonth, $endOfLastMonth])->sum('paid_amount');
        $total = Payment::sum('paid_amount');

        $percentChange = $lastMonthTotal > 0
            ? number_format((($thisMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100, 1)
            : null;

        $byType = Payment::selectRaw('type, SUM(paid_amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type');

        $this->kpis = [
            'total' => $total,
            'percent_change' => $percentChange,
            'types' => [
                'order' => $byType['order'] ?? 0,
                'penalty' => $byType['penalty'] ?? 0,
                'extension' => $byType['extension'] ?? 0,
            ]
        ];
    }

    #[Computed()]
    public function list()
    {
        $query =  Payment::with('user', 'order', 'rental');

        if ($this->filters['type'] != 'all') {
            $query->where('type', $this->filters['type']);
        }

        return $query->orderBy($this->sort['column'] ?: 'created_at', $this->sort['direction'] ?: 'desc')
            ->paginate(20);
    }

    public $detailModal = false;
    public function showDetailModal($paymentId)
    {
        $payment = Payment::with('user', 'order', 'rental')->find($paymentId);

        if ($payment->type == 'order') {
            $payment->books = $payment->order->orderItems->map(function ($order) {
                $book = $order->book;
                $book->rental_duration = $order->rental_duration_weeks;
                $book->price = $order->total_price;
                return $book;
            }) ?? [];
        } else if ($payment->type == 'penalty') {
            $payment->books = [$payment->rental?->book];
        } else if ($payment->type == 'extension') {
            $payment->books = [$payment->rental?->book];
        }
        $this->selectedPayment = $payment;
        $this->detailModal = true;
    }

    public function render()
    {

        return view('livewire.admin.payment-page');
    }
}
