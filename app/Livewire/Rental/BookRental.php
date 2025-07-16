<?php

namespace App\Livewire\Rental;

use App\Models\Rental;
use App\Traits\WithDataTable;
use Livewire\Attributes\Computed;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class BookRental extends Component
{
    use WithDataTable, Interactions;

    public $headers = [
        ['index' => 'user.name', 'label' => 'User'],
        ['index' => 'book_title', 'label' => 'Title'],
        ['index' => 'rented_at', 'label' => 'Rented Date'],
        ['index' => 'due_date', 'label' => 'Due Date'],
        ['index' => 'returned_at', 'label' => 'Return Date'],
        ['index' => 'status', 'label' => 'Status'],
    ];
    public $statusFilter, $search;

    public function mount()
    {
        $this->sort = [
            'column' => 'book.title',
            'direction' => 'asc'
        ];
    }

    #[Computed()]
    public function activeRentals() {
        return Rental::where('status', 'rented')->count();
    }

    #[Computed()]
    public function overdueRentals() {
        return Rental::where('status', 'overdue')->count();
    }

    #[Computed(persist: true)]
    public function list()
    {
        return Rental::with(['user', 'book'])
            ->when(
                $this->search,
                fn($q) =>
                $q->whereHas('user', fn($query) => $query->where('name', 'like', "%{$this->search}%"))
                    ->orWhereHas('book', fn($query) => $query->where('title', 'like', "%{$this->search}%"))
            )
            ->when($this->statusFilter, fn($q) => $q->whereIn('status', (array) $this->statusFilter))
            ->orderBy($this->sort['key'] ?? 'id', $this->sort['direction'] ?? 'desc')
            ->paginate($this->perPage);
    }

    public function updatedStatusFilter() {
        unset($this->list);
    }

    public function updatedSearch() {
        unset($this->list);
    }

    public function render()
    {
        return view('livewire.rental.book-rental');
    }
}
