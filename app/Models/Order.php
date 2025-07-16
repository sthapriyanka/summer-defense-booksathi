<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'total_amount',
        'payment_mode',
        'ordered_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItems::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public static function generateOrderCode(): string
    {
        $date = now()->format('Ymd');
        $count = Order::whereDate('created_at', today())->count() + 1;
        return 'ORD-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

}
