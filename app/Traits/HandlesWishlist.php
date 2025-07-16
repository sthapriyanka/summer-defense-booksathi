<?php

namespace App\Traits;

use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;

trait HandlesWishlist
{
    public function toggleWishlist($type, $bookId)
    {
        if (!Auth::check()) return redirect()->to(route('login'));
        if ($type === "add") {
            app(WishlistService::class)->addToWishlist($bookId);
            $this->toast()->success('Book added to wishlist.')->send();
        } else {
            app(WishlistService::class)->removeFromWishlist($bookId);
            $this->toast()->success('Book removed from wishlist.')->send();
        }

        $this->dispatch("wishlist-updated");

        // Call customizable method
        $this->afterWishlistToggled();
    }

    // You can override this in the component
    protected function afterWishlistToggled()
    {
        // Default: do nothing
    }
}
