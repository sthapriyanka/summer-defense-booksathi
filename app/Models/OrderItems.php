<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'book_id',
        'user_id',
        'rental_duration_weeks',
        'total_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function rental() {
        return $this->hasOne(Rental::class);
    }


}

