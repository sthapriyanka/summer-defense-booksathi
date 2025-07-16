<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    public function addToWishlist($bookId)
    {
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'book_id' => $bookId
        ]);
    }

    public function removeFromWishlist($bookId)
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('book_id', $bookId)->first();
        $wishlist->delete();
    }
}
