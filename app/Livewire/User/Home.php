<?php

namespace App\Livewire\User;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class Home extends Component
{
    use WithPagination;
     public function render()
    {
        $books = Book::latest()->paginate(12); // or use ->where('status', 'active') if needed
        return view('livewire.user.home', compact('books'));
    }
}
