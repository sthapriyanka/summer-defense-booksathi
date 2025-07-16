<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $totalBooks, $bookGrowth;
    public $rentedToday, $rentedGrowth;
    public $totalUsers, $userGrowth;
    public $activeRentals, $rentalGrowth;

    public function mount()
    {
        $this->getStats();
    }

    public function getStats()
    {
        // Total Books (Month to Month)
        $currentMonthBooks = Book::whereMonth('created_at', now()->month)->count();
        $previousMonthBooks = Book::whereMonth('created_at', now()->subMonth()->month)->count();
        $this->totalBooks = Book::count();
        $this->bookGrowth = $this->calculateGrowth($previousMonthBooks, $currentMonthBooks);

        // Rented Today vs Yesterday
        $this->rentedToday = Rental::whereDate('rented_at', today())->count();
        $yesterdayRented = Rental::whereDate('rented_at', today()->subDay())->count();
        $this->rentedGrowth = $this->calculateGrowth($yesterdayRented, $this->rentedToday);

        // Total Users (Month to Month)
        $currentMonthUsers = User::whereMonth('created_at', now()->month)->count();
        $previousMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)->count();
        $this->totalUsers = User::count();
        $this->userGrowth = $this->calculateGrowth($previousMonthUsers, $currentMonthUsers);

        // Active Rentals (This Week vs Last Week)
        $activeRentalQuery = Rental::whereNotNull('rented_at')->whereNull('returned_at');
        $this->activeRentals = $activeRentalQuery->count();
        $thisWeek = now()->startOfWeek();
        $lastWeek = now()->subWeek()->startOfWeek();

        $thisWeekRentals = $activeRentalQuery->whereBetween('rented_at', [$thisWeek, now()])->count();
        // dd($thisWeekRentals);
        $lastWeekRentals = $activeRentalQuery->whereBetween('rented_at', [$lastWeek, $thisWeek])->count();
        $this->rentalGrowth = $this->calculateGrowth($lastWeekRentals, $thisWeekRentals);
    }


    private function calculateGrowth($previous, $current)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100);
    }

    #[Computed(persist: true)]
    public function mostRentedBooks()
    {
        $backgroundColors = [
            'rgb(22, 163, 74)',
            'rgb(22, 163, 74)',
            'rgb(5, 150, 105)',
            'rgb(4, 120, 87)',
            'rgb(6, 95, 70)'
        ];
        $rentalCounts = DB::table('rentals')
            ->join('books', 'rentals.book_id', '=', 'books.id')
            ->select('books.title', DB::raw('COUNT(rentals.book_id) as rental_count'))
            ->groupBy('books.id', 'books.title')
            ->orderByDesc('rental_count')
            ->take(5)
            ->get();
        foreach ($rentalCounts as $index => $rentalCount) {
            $rentalCount->color = $backgroundColors[$index];
        }
        return $rentalCounts;
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard')
            ->title('Admin Dashboard');
    }
}
