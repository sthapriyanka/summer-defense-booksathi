<?php

namespace App\Livewire\User;

use App\Traits\HandlesWishlist;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class Wishlist extends Component
{
    use Interactions, HandlesWishlist;

    #[Computed(persist: true)]
    public function wishlistedBooks()
    {
        // dd(Auth::user()->wishlistedBooks()->get());
        return Auth::user()->wishlistedBooks()->get();
    }

    protected function afterWishlistToggled()
    {
        unset($this->wishlistedBooks);
    }

    public function handleAddToCart($bookId)
    {
        $added = app(\App\Services\AddToCartService::class)->addBookToCart($bookId);
        if ($added) {
            $this->toast()->success('Book added to cart.')->send();
        } else {
            $this->toast()->error('Book already in cart.')->send();
        }
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.user.wishlist')
            ->title('Wishlist - Book Sathi');
    }
}
