<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddToCartService
{
    public function addBookToCart(int $bookId)
    {
        $user = Auth::user();

        // Find or create active cart
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Check if book is already in cart
        $exists = CartItem::where('cart_id', $cart->id)
            ->where('book_id', $bookId)
            ->exists();

        if (!$exists) {
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
            return true;
        }

        return false; // book already in cart
    }

    public function getCartBookIds()
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return [];
        }

        return $cart->items()->pluck('book_id')->toArray();
    }

    public function getCartItems()
    {
        $user = Auth::user();

        $cart = Cart::with('items')->where('user_id', $user->id)->first();

        if (!$cart) {
            return [];
        }

        return $cart->items()->get();
    }

    public function removeBookFromCart(int $bookId)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return false;
        }

        return $cart->items()->where('book_id', $bookId)->delete();
    }

    public function removeBooksFromCart(array $bookIds)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return false;
        }

        return $cart->items()->whereIn('book_id', $bookIds)->delete();
    }

}
