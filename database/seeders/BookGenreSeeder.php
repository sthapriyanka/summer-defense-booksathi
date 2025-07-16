<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
    {
        $genres = Genre::factory()->count(10)->create();

        // Create 100 books
        Book::factory()
            ->count(100)
            ->create()
            ->each(function ($book) use ($genres) {
                // Attach 1 to 3 random genres per book
                $book->genres()->attach(
                    $genres->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}
