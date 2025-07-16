<?php

namespace App\Livewire\User;

use App\Models\Book;
use App\Traits\HandlesWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class BookDetail extends Component
{
    use Interactions, HandlesWishlist;

    public Book $book;
    public $bookId;
    public $rentalDuration = 1;
    public $reviewAdded = false;
    public $addedToCart = false;

    #[Validate('required|min:1')]
    public $bookRating = 0;

    #[Validate('required')]
    public $comment = "";

    public function mount($id)
    {
        $this->bookId = $id;
        $this->loadBook();
        $this->totalPrice = $this->book['price'] * $this->rentalDuration;
    }

    public function loadBook()
    {
        $this->book = Book::with([
            'genres',
            'reviews' => function ($query) {
                $query->orderByRaw('user_id = ? DESC', [Auth::id()]);
            },
            'reviews.user', // Eager load reviews with user information
            'rentals' => function ($query) {
                $query->where('status', 'active');
            }
        ])->where('id', $this->bookId)->firstOrFail();
        $this->reviewAdded = $this->book->reviews()->where('user_id', Auth::id())->exists();

        $cartBookIds = app(AddToCartService::class)->getCartBookIds();

        $this->addedToCart = in_array($this->bookId, $cartBookIds);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 2) ?? 0;
    }

    public function evaluate(int $rating): void
    {
        $this->bookRating = $rating;
    }

    public function submitReview()
    {
        $this->validate();
        $book = Book::findOrFail($this->bookId);

        $book->reviews()->create([
            'comment' => $this->comment,
            'rating' => $this->bookRating,
            'user_id' => Auth::id(),
        ]);

        // Recalculate and update average rating
        $book->rating = $book->getAverageRating();
        $book->save();
        $this->loadBook();
    }

    public function handleAddToCart($bookId){
        
        $added = app(AddToCartService::class)->addBookToCart($bookId);

        if ($added) {
            $this->toast()->success('Book added to cart.')->send();
        } else {
            $this->toast()->error('Book already in cart.')->send();
        }
        $this->addedToCart = true;
        $this->dispatch("cart-updated");

    }

    protected function afterWishlistToggled()
    {
        $this->loadBook();
    }

    public function render()
    {
        return view('livewire.user.book-detail')
        ->title($this->book->title . ' - Book Sathi');
    }
}
