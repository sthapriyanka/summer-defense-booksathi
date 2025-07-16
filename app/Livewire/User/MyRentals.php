<?php

namespace App\Livewire\User;

use App\Models\Book;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class MyRentals extends Component
{
    use Interactions;

    public $activeBookCount = 0;
    public $overdueBookCount = 0;
    public $rentedBookCount = 0;

    // Extension modal properties
    public $showExtendModal = false;
    public $selectedRentalId = null;
    public $extensionWeeks = 1; // default to 1 week
    public $extensionCost = 700; // Default 7 days * 100 Rs
    public $currentDueDate = null;
    public $newDueDate = null;

    public $selectedBookId = null;
    public $reviewModal = false;

    public $reviewDetail = null;

    public $showLateFeeModal = false;
    public $lateFeeDetails = [
        'rentalId' => null,
        'bookTitle' => '',
        'author' => '',
        'coverImage' => '',
        'daysOverdue' => 0,
        'lateFeePerDay' => 20,
        'totalLateFee' => 0,
    ];

    public function mount()
    {
        $this->setRentalSummary();
    }

    public function setRentalSummary()
    {
        $this->activeBookCount = count($this->activeBooks());
        $this->overdueBookCount = count($this->overdueBooks());
        $this->rentedBookCount = $this->rentedBooks();
    }

    public function rentedBooks()
    {
        return Rental::where('user_id', Auth::id())->count();
    }

    #[Computed()]
    public function overdueBooks()
    {
        $overdueRentals = Rental::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'overdue')
            ->get();

        return $overdueRentals->map(function ($rental) {
            $rentedAt = Carbon::parse($rental->rented_at);
            $dueDate = Carbon::parse($rental->due_date);
            $daysOverDue = (int) now()->diffInDays($dueDate);
            return [
                'id' => $rental->id,
                'title' => $rental->book->title,
                'author' => $rental->book->author,
                'coverImage' => $rental->book->image ?? 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=250&fit=crop',
                'rentedDate' => $rentedAt->format('Y-m-d'),
                'dueDate' => $dueDate->format('Y-m-d'),
                'isOverdue' => true,
                'daysLeft' => 0,
                'daysOverdue' => $daysOverDue,
                'rentalWeeks' => ceil($rentedAt->diffInDays($dueDate) / 7),
                'weeklyPrice' => $rental->book->rental_price_per_week
            ];
        })->toArray();
    }

    #[Computed()]
    public function activeBooks()
    {
        $activeRentals = Rental::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'rented')
            ->get();

        // dd($activeRentals);

        return $activeRentals->map(function ($rental) {
            $rentedAt = Carbon::parse($rental->rented_at);
            $dueDate = Carbon::parse($rental->due_date);
            $daysLeft = (int) now()->diffInDays($dueDate);

            return [
                'id' => $rental->id,
                'title' => $rental->book->title,
                'author' => $rental->book->author,
                'coverImage' => $rental->book->image ?? 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=250&fit=crop',
                'rentedDate' => $rentedAt->format('Y-m-d'),
                'dueDate' => $dueDate->format('Y-m-d'),
                'isOverdue' => false,
                'daysLeft' => $daysLeft,
                'daysOverdue' => 0,
                'rentalWeeks' => ceil($rentedAt->diffInDays($dueDate) / 7),
                'weeklyPrice' => $rental->book->rental_price_per_week
            ];
        })->toArray();
    }

    public function viewReview($bookId)
    {
        $this->reviewModal = true;
        $book = Book::find($bookId);

        $this->reviewDetail = $book->myReview();
    }


    public $writeReviewModal = false;
    public function openWriteReviewModal($bookId)
    {
        $this->writeReviewModal = true;
        $this->selectedBookId = $bookId;
    }

    public function evaluate(int $rating): void
    {
        $this->newRating = $rating;
    }

    public $newRating, $newReview;
    public function writeReview()
    {
        $this->validate([
            'newRating' => 'required|integer|min:1|max:5',
            'newReview' => 'required|string|min:10|max:500',
        ], [
            'newRating.required' => 'Please select a rating.',
            'newReview.required' => 'Please write a review.',

        ]);

        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $this->selectedBookId,
            'rating' => $this->newRating,
            'comment' => $this->newReview
        ]);

        $this->newRating = null;
        $this->newReview = null;

        $this->writeReviewModal = false;
        $this->selectedBookId = null;
        unset($this->rentalHistory);
        $this->toast()->success('Review submitted successfully')->send();
    }

    public function closeWriteReviewModal()
    {
        $this->writeReviewModal = false;
        $this->selectedBookId = null;
        $this->newRating = null;
        $this->newReview = null;
    }

    #[Computed()]
    public function rentalHistory()
    {
        // dd(Rental::with('book')
        // ->where('user_id', Auth::id())
        // ->where('status', 'returned')->get());
        return Rental::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'returned')
            ->get()->map(function ($rental) {
                $rental->myRating = $rental->book->myReview()?->rating;
                return $rental;
            });
    }

    public function openExtendModal($rentalId)
    {
        $this->selectedRentalId = $rentalId;
        $rental = Rental::findOrFail($rentalId);

        $this->currentDueDate = $rental->due_date;
        $this->extensionWeeks = 1; // default to 1 week
        $this->calculateExtensionCost();
        $this->calculateNewDueDate();

        $this->showExtendModal = true;
    }

    public function updateExtensionWeeks($weeks)
    {
        if ($weeks < 1) {
            $weeks = 1;
            return $this->toast()->error('Please select at least 1 week')->send();
        }
        if ($weeks > 4) {
            $weeks = 4;
            return $this->toast()->error('Please select at most 4 weeks')->send();
        }
        $this->extensionWeeks = $weeks;
        $this->calculateExtensionCost();
        $this->calculateNewDueDate();
    }

    public function calculateExtensionCost()
    {
        $rental = Rental::findOrFail($this->selectedRentalId);
        $bookPricePerWeek = $rental->book->rental_price_per_week;

        $this->extensionCost = $this->extensionWeeks * $bookPricePerWeek;
    }

    public function calculateNewDueDate()
    {
        $rental = Rental::findOrFail($this->selectedRentalId);

        $this->newDueDate = Carbon::parse($rental->due_date)
            ->addWeeks($this->extensionWeeks)
            ->format('Y-m-d');
    }

    public function confirmExtension()
    {
        $rental = Rental::findOrFail($this->selectedRentalId);
        $bookPrice = $rental->book->rental_price_per_week;

        $totalPrice = $this->extensionWeeks * $bookPrice;

        Payment::create([
            'user_id' => Auth::id(),
            'rental_id' => $rental->id,
            'total_amount' => $totalPrice,
            'paid_amount' => $totalPrice,
            'paid_at' => now(),
            'status' => 'paid',
            'payment_mode' => 'cash',
            'type' => 'extension',
        ]);

        $rental->due_date = Carbon::parse($rental->due_date)->addWeeks($this->extensionWeeks);

        if ($rental->status === 'overdue') {
            $rental->status = 'rented';
        }

        $rental->save();

        $this->showExtendModal = false;
        $this->selectedRentalId = null;

        $this->setRentalSummary();

        $this->toast()->success('Extension successful!')->send();
    }

    public function cancelExtension()
    {
        $this->showExtendModal = false;
        $this->selectedRentalId = null;
    }

    public function returnBook($rentalId)
    {
        $rental = Rental::findOrFail($rentalId);
        $rental->status = 'returned';
        $rental->returned_at = now();
        $rental->save();

        // Increment available copies for the book
        $book = $rental->book;
        $book->available_copies = $book->available_copies + 1;
        $book->save();

        // Refresh the data
        $this->setRentalSummary();

        session()->flash('message', 'Book returned successfully!');
    }

    public function openLateFeeModal($rentalId)
    {
        $rental = Rental::with('book')->findOrFail($rentalId);
        $dueDate = Carbon::parse($rental->due_date);
        $daysOverdue = abs((int) now()->diffInDays($dueDate));

        $lateFeeRate = $rental->book->late_fee_per_day ?? 20;

        $this->lateFeeDetails = [
            'rentalId' => $rentalId,
            'bookTitle' => $rental->book->title,
            'author' => $rental->book->author,
            'coverImage' => $rental->book->image ?? 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=200&h=250&fit=crop',
            'daysOverdue' => $daysOverdue,
            'lateFeePerDay' => $lateFeeRate,
            'totalLateFee' => $daysOverdue * $lateFeeRate,
        ];

        $this->showLateFeeModal = true;
    }

    public function payLateFee()
    {
        $amount = $this->lateFeeDetails['totalLateFee'];
        $rentalId = $this->lateFeeDetails['rentalId'];

        Payment::create([
            'user_id' => Auth::id(),
            'total_amount' => $amount,
            'paid_amount' => $amount,
            'rental_id' => $rentalId,
            'paid_at' => now(),
            'status' => 'paid',
            'type' => 'penalty',
            'payment_mode' => 'cash',
        ]);

        // Optionally reset overdue status to rented
        $rental = Rental::find($this->lateFeeDetails['rentalId']);
        if ($rental && $rental->status === 'overdue') {
            $rental->due_date = now();
            $rental->status = 'rented';
            $rental->save();
        }

        $this->showLateFeeModal = false;
        $this->toast()->success('Late fee paid successfully')->send();
    }


    public function render()
    {
        return view('livewire.user.my-rentals')
            ->title('My Rentals - Book Sathi');
    }
}
