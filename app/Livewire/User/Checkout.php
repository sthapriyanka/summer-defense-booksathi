<?php

namespace App\Livewire\User;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\User;
use DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class Checkout extends Component
{   use Interactions;

    public $selectedItems = [];

    public $cartItems = [];

    public $name, $email, $phone;

    public $street, $city, $state, $zip;

    public $payment_method = 'card';
    public $cardNumber, $expiry, $cvv, $cardName;

    public $shipping_method = 'pickup'; // default

    public function mount(){
        $this->selectedItems = session('selected_items', []);

        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;

        $cart = Cart::where('user_id', auth()->id())->first();
        $this->cartItems = $cart->items()->with('book')
            ->whereIn('book_id', $this->selectedItems)
            ->get();
    }

    public function getTotalProperty()
    {
        return $this->cartItems->sum(fn($item) =>
            $item->book->rental_price_per_week * $item->rental_duration_weeks
        );
    }

    public function render()
    {
        return view('livewire.user.checkout')
         ->title('Checkout - Book Sathi');
    }

    public function calculateTotal()
    {
         return $this->cartItems->sum(fn($item) =>
            $item->total_price
        );

    }
    public function rules()
    {
        $rules = [
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'phone' => 'required|string|min:7',
        ];
        if ($this->payment_method === 'card') {
            $rules['cardNumber'] = 'required|digits_between:12,19';
            $rules['expiry'] = 'required|date_format:m/y';
            $rules['cvv'] = 'required|digits_between:3,4';
            $rules['cardName'] = 'required|string|min:2';
        }
        return $rules;
    }

    public function placeOrder()
    {
        $this->validate();
        DB::beginTransaction();

        try {
            $totalAmount = $this->calculateTotal();

            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'order_number' => Order::generateOrderCode(),
                'payment_mode' => $this->payment_method
            ]);

            foreach ($this->cartItems as $cart) {
                $orderItem = $order->orderItems()->create([
                    'order_id' => $order->id,
                    'book_id' => $cart->book_id,
                    'rental_duration_weeks' => $cart->rental_duration_in_weeks,
                    'total_price' => $cart->total_price,
                ]);
                
                $cart->delete();
            }
            User::where('id', auth()->id())->update([
                'phone' => $this->phone
            ]);
            
            DB::commit();

            session()->forget('selected_items');
            $this->toast()->success('Order placed successfully you can collect your books')->send();

            return redirect()->route('orders');

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->toast()->error($e->getMessage())->send();
        }
    }

}
