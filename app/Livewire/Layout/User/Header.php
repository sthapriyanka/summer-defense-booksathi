<?php

namespace App\Livewire\Layout\User;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Header extends Component
{
    public $wishlistCount = 0;
    public $cartCount = 0;

    #[Url('search')]
    public $search = "";


    public function mount()
    {
        $this->setWishlistCount();
        $this->setCartCount();
    }
    public function clearSearch()
    {
    $this->search = '';
    // Optionally, redirect to /books without the search parameter
    return redirect()->route('books');
    }

    #[On('wishlist-updated')]
    public function setWishlistCount()
    {
        if (Auth::check())
            $this->wishlistCount = Auth::user()->wishlist()->count();
    }

    #[On('cart-updated')]
    public function setCartCount()
    {
        if (Auth::check())
            $this->cartCount = Auth::user()->cart ? Auth::user()->cart->items()->count() : 0;
    }

    public function searchBook()
    {
        $this->redirect(route('books', ['search' => $this->search]));
    }

    public function render()
    {
        return view('livewire.layout.user.header');
    }
}
