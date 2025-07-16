<?php

namespace App\Livewire\User;

use App\Traits\HandlesWishlist;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use App\Services\WishlistService;
use App\Services\AddToCartService;


#[Layout('layouts.user')]
class HomePage extends Component
{
    use Interactions, HandlesWishlist;

    #[Computed(persist: true)]
    public function bookOfTheMonth()
    {
        return Book::where('is_featured', true)->first();
    }

    #[Computed(persist: true)]
    public function featuredBooks()
    {
        return Book::featured()->take(4)->get();
    }

    #[Computed(persist: true)]
    public function newArrivals()
    {
        return Book::newArrivals()->take(4)->get();
    }

    #[Computed(persist: true)]
    public function genresWithCounts()
    {

        return DB::table('genres')
            ->join('books_genres', 'genres.id', '=', 'books_genres.genre_id')
            ->select('genres.id', 'genres.name', 'genres.icon', 'genres.color', DB::raw('COUNT(books_genres.book_id) as count'))

            ->groupBy('genres.id', 'genres.name', 'genres.icon', 'genres.color')
            ->orderByDesc('count') // Optional: get top genres by count
            ->limit(4)
            ->get()
            ->toArray();
    }

    protected function afterWishlistToggled()
    {
        unset($this->featuredBooks, $this->newArrivals);
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

    public function render()
    {
        return view('livewire.user.home-page')
        ->title('Home - Book Sathi');
    }
}
