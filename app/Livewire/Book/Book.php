<?php

namespace App\Livewire\Book;

use App\Traits\WithDataTable;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use TallStackUi\Traits\Interactions;
use App\Models\Book as ModelsBook;

#[Title('Book Add')]

class Book extends Component
{
    use WithDataTable, Interactions;
    public bool $bookForm = false;
    public ?int $editingId = null;

    public ?string $name = null;

    public $bookId, $title, $isbn, $description, $publication_date, $pages,
    $language = 'English', $cover_image, $rental_price_per_week, $book,
    $total_copies = 1, $available_copies = 1, $is_featured = false,
    $status = 'active';

     public $headers = [
        ['index' => 'title', 'label' => 'Title'],
        ['index' => 'price', 'label' => 'Price'],
        ['index' => 'isbn', 'label' => 'ISBN'],
        ['index' => 'status', 'label' => 'Status'],
        ['index' => 'action', 'label' => 'Action', 'sortable' => false],
    ];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|unique:books,isbn,' . $this->editingId,
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'pages' => 'nullable|integer',
            'language' => 'required|string',
            'rental_price_per_week' => 'required|numeric|min:0',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'status' => 'in:active,inactive,maintenance',
        ];
    }

    public function mount()
    {
        $this->sort = [
            'column' => 'title',
            'direction' => 'asc'
        ];
    }

    #[Computed(persist: true)]
    public function list()
    {
        return ModelsBook::latest()->paginate($this->perPage);
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->bookForm = true;

        $book = ModelsBook::find($id);
        if (!$book) {
            $this->toast()->error('Book not found')->send();
            return;
        }

        $this->fill($book->toArray());
    }

    public function clearForm()
    {
        $this->editingId = null;
        $this->reset([
            'bookId', 'title', 'isbn', 'description', 'publication_date', 'pages',
            'language', 'cover_image', 'rental_price_per_week', 'total_copies',
            'available_copies', 'is_featured', 'status'
        ]);
        $this->clearValidation();
    }

    protected function formData()
    {
        return $this->only([
            'title', 'isbn', 'description', 'publication_date', 'pages',
            'language', 'rental_price_per_week', 'total_copies',
            'available_copies', 'is_featured', 'status'
        ]);
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $book = ModelsBook::find($this->editingId);
            if (!$book) {
                $this->toast()->error("Book not found")->send();
                return;
            }
            $book->update($this->formData());
        } else {
            ModelsBook::create($this->formData());
        }

        $this->toast()->success("Book " . ($this->editingId ? 'updated' : 'added') . " successfully")->send();

        unset($this->list);
        $this->bookForm = false;
        $this->clearForm();
    }

    public function delete($id)
    {
        $book = ModelsBook::find($id);
        if (!$book) {
            $this->toast()->error('Book not found')->send();
            return;
        }

        $book->delete();
        $this->toast()->success('Book deleted successfully')->send();
        unset($this->list);
    }

    public function render()
    {
        return view('livewire.book.book');
    }
}
