<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'isbn',
        'author',
        'description',
        'publication_date',
        'pages',
        'language',
        'cover_image',
        'rental_price_per_week',
        'total_copies',
        'available_copies',
        'is_featured',
        'status',
        'rating',
        'publisher',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'is_featured' => 'boolean',
        'rental_price_per_week' => 'decimal:2',
    ];

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'books_genres');
    }

    public function getIsAvailableAttribute()
    {
        return $this->available_copies != 0;
    }
    public function getAverageRating()
    {
        return (int) round($this->reviews()->avg('rating'));
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNewArrivals($query)
    {
        return $query->orderBy('publication_date', 'desc');
    }

    public function getWishlistedAttribute()
    {
        return $this->wishlist()->where('user_id', Auth::id())->exists();
    }

    public function getAddedToCartAttribute()
    {   $cart = Cart::where('user_id', Auth::id())->first();
        if(!$cart){
            return false;
        }
        return $this->cartItems()->where('cart_id', $cart->id)->exists();
    }

    public function getImageAttribute()
    {
        return asset( $this->cover_image);
    }

    public function myReview(){
        return $this->reviews()->where('user_id', Auth::id())->first();
    }
}
