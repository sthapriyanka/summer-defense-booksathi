<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Book;

class BooksTable extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    // Modal and form properties
    public $showModal = false;
    public $editingBookId = null;

    // Form fields
    public $title = '';
    public $author = '';
    public $isbn = '';
    public $description = '';
    public $publication_date = '';
    public $pages = '';
    public $language = 'English';
    public $publisher = '';
    public $cover_image;
    public $rental_price_per_week = '';
    public $total_copies = 1;
    public $available_copies = 1;
    public $is_featured = false;
    public $status = 'active';
    public $selectedGenres = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'title'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function getRules()
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|unique:books,isbn,' . $this->editingBookId,
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'language' => 'required|string|max:50',
            'publisher' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'rental_price_per_week' => 'required|numeric|min:0',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,maintenance',
            'selectedGenres' => 'array',
        ];
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function openModal($bookId = null)
    {
        $this->showModal = true;
        $this->editingBookId = $bookId;

        if ($bookId) {
            $book = Book::with('genres')->findOrFail($bookId);
            $this->fill($book->toArray());
            $this->publication_date = $book->publication_date ? $book->publication_date->format('Y-m-d') : '';
            $this->selectedGenres = $book->genres->pluck('id')->toArray();
        } else {
            $this->resetForm();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingBookId = null;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->author = '';
        $this->isbn = '';
        $this->description = '';
        $this->publication_date = '';
        $this->pages = '';
        $this->language = 'English';
        $this->publisher = '';
        $this->cover_image = null;
        $this->rental_price_per_week = '';
        $this->total_copies = 1;
        $this->available_copies = 1;
        $this->is_featured = false;
        $this->status = 'active';
        $this->selectedGenres = [];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'publication_date' => $this->publication_date ?: null,
            'pages' => $this->pages ?: null,
            'language' => $this->language,
            'publisher' => $this->publisher,
            'rental_price_per_week' => $this->rental_price_per_week,
            'total_copies' => $this->total_copies,
            'available_copies' => $this->available_copies,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
        ];

        // Handle cover image upload
        if ($this->cover_image) {
            $imagePath = $this->cover_image->store('books/covers', 'public');
            $data['cover_image'] = "storage/".$imagePath;
        }

        if ($this->editingBookId) {
            $book = Book::findOrFail($this->editingBookId);
            $book->update($data);
            $book->genres()->sync($this->selectedGenres);
            session()->flash('message', 'Book updated successfully!');
        } else {
            $book = Book::create($data);
            $book->genres()->attach($this->selectedGenres);
            session()->flash('message', 'Book added successfully!');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function delete($bookId)
    {
        $book = Book::findOrFail($bookId);

        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        session()->flash('message', 'Book deleted successfully!');
    }

    public function toggleFeatured($bookId)
    {
        $book = Book::findOrFail($bookId);
        $book->update(['is_featured' => !$book->is_featured]);
        session()->flash('message', 'Book featured status updated!');
    }

    public function render()
    {
        $books = Book::with('genres')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('author', 'like', '%' . $this->search . '%')
                        ->orWhere('isbn', 'like', '%' . $this->search . '%')
                        ->orWhere('publisher', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $genres = Genre::orderBy('name')->get();

        return view('livewire.admin.books-table', [
            'books' => $books,
            'genres' => $genres
        ])->layout('layouts.app')
        ->title('Manage Books - Admin Dashboard');
    }
}