<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['cart_id', 'book_id', 'quantity', 'rental_duration_in_weeks', 'total_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeCart($query){
        return $query->where('user_id', Auth::id());
    }

}
