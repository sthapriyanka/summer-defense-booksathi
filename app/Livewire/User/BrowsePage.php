<?php

namespace App\Livewire\User;

use App\Traits\HandlesWishlist;
use App\Models\Book;
use App\Models\Genre;
use App\Services\WishlistService;
use App\Services\AddToCartService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class BrowsePage extends Component
{
    use WithPagination, Interactions, HandlesWishlist;

    // filters options
    public $languageOptions = [];
    public $availabilityOptions = [];
    public $publicationYearRanges = [];
    public $maxPrice = 100;
    public $sortOptions = [];

    #[Url('search')]
    public $search = "";

    #[Url('genre')]
    public $selectedGenre = "";

    // filters values
    public $language = "";
    public $availability = "";
    public $publicationYearRange = "";
    public $priceRange = 0;
    public $sortBy = "";
    public $viewMode = 'grid';
    public function mount()
    {
        // Get unique languages from books table
        $this->languageOptions = [
            '' => 'All Languages',
            ...Book::select('language')
                ->distinct()
                ->pluck('language', 'language')
                ->toArray()
        ];

        $this->availabilityOptions = [
            '' => 'All books',
            'in-stock' => 'In Stock',
            'out-of-stock' => 'Out of Stock'
        ];

        // Define publication year ranges
        $this->publicationYearRanges = [
            '' => 'All Years',
            'before-1990' => 'Before 1990',
            '1990-2000' => '1990 - 2000',
            '2000-2010' => '2000 - 2010',
            '2010-2020' => '2010 - 2020',
            'after-2020' => 'After 2020'
        ];

        $this->sortOptions = [
            'newest' => 'Newest First',
            'oldest' => 'Oldest First',
            'price-low' => 'Price: Low to High',
            'price-high' => 'Price: High to Low',
            'rating' => 'Highest Rated',
            'title' => 'Title A-Z'
        ];

        // Get max price from database
        $this->maxPrice = Book::max('rental_price_per_week') ?? 1000;
        $this->clearFilter();
    }
    
    public function clearFilter()
    {
        $this->language = "";
        $this->availability = "";
        $this->publicationYearRange = "";
        $this->priceRange = $this->maxPrice;
        $this->sortBy = array_keys($this->sortOptions)[0];
        $this->resetPage();
        unset($this->bookList);
    }

    public function clearSearch()
    {
        $this->search = '';
        return redirect()->route('books');
    }

    #[Computed()]
    public function bookList()
    {
        $query = Book::query();

        // Apply genre filter
        if ($this->selectedGenre) {
            $query->whereHas('genres', function ($q) {
                $q->where('name', $this->selectedGenre);
            });
        }

        // Apply language filter
        if ($this->language) {
            $query->where('language', $this->language);
        }

        // Apply availability filter
        if ($this->availability) {
            if ($this->availability === 'in-stock') {
                $query->where('available_copies', '>', 0);
            } else if ($this->availability === 'out-of-stock') {
                $query->where('available_copies', 0);
            }
        }

        // Apply publication year range filter
        if ($this->publicationYearRange) {
            switch ($this->publicationYearRange) {
                case 'before-1990':
                    $query->whereYear('publication_date', '<', 1990);
                    break;
                case '1990-2000':
                    $query->whereYear('publication_date', '>=', 1990)
                        ->whereYear('publication_date', '<', 2000);
                    break;
                case '2000-2010':
                    $query->whereYear('publication_date', '>=', 2000)
                        ->whereYear('publication_date', '<', 2010);
                    break;
                case '2010-2020':
                    $query->whereYear('publication_date', '>=', 2010)
                        ->whereYear('publication_date', '<', 2020);
                    break;
                case 'after-2020':
                    $query->whereYear('publication_date', '>=', 2020);
                    break;
            }
        }

        // Apply price range filter
        if ($this->priceRange > 0) {
            $query->where('rental_price_per_week', '<=', $this->priceRange);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'newest':
                $query->latest('publication_date');
                break;
            case 'oldest':
                $query->oldest('publication_date');
                break;
            case 'price-low':
                $query->orderBy('rental_price_per_week', 'asc');
                break;
            case 'price-high':
                $query->orderBy('rental_price_per_week', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%');
        }

        return $query->paginate(10);
    }

    #[Computed()]
    public function availableGenres()
    {
        return Genre::withCount('books')
            ->having('books_count', '>', 0)
            ->orderBy('name')
            ->get();
    }

    public function updated($property)
    {
        // Reset pagination when any filter changes
        if (in_array($property, ['language', 'availability', 'publicationYearRange', 'priceRange', 'sortBy', 'selectedGenre'])) {
            $this->resetPage();
            unset($this->bookList);
        }
    }

    public function changeViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    protected function afterWishlistToggled()
    {
        unset($this->bookList);
    }

    public function handleAddToCart($bookId)
    {

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
        return view('livewire.user.browse-page')
        ->title('Books Browse');
    }
}
