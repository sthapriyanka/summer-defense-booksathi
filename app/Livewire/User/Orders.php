<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderItems;
use Livewire\Attributes\Layout;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class Orders extends Component
{
    use Interactions;

    public function cancelOrder($orderId)
    {
        $order = Order::with('orderItems')->find($orderId);
        if (!$order)
            return $this->toast()->error('Order not found.');

        $order->status = 'cancelled';
        $order->save();

        $this->toast()->error('Order has been cancelled.');
    }

    public function render()
    {
        $orderItems = OrderItems::with(['order.user', 'book'])
            ->whereHas('order', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();

        return view('livewire.user.orders', compact('orderItems'))
            ->title('My Orders - Book Sathi');
    }
}
