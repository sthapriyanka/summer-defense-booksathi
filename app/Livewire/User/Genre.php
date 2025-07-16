<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user')]
class Genre extends Component
{
    #[Computed(persist: true)]
    public function genresWithCount()
    {
        return DB::table('genres')
            ->join('books_genres', 'genres.id', '=', 'books_genres.genre_id')
            ->select(
                'genres.id',
                'genres.name',
                'genres.icon',
                'genres.color',
                'genres.description',
                DB::raw('COUNT(books_genres.book_id) as count')
            )
            ->groupBy('genres.id', 'genres.name', 'genres.icon', 'genres.color', 'genres.description')
            ->orderByDesc('count')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.user.genre') ->title('Genres - Book Sathi');
    }
}
