<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            for ($i = 0; $i < 5; $i++) {
                $book = Book::inRandomOrder()->first();
                if ($book->reviews()->where('user_id', $user->id)->exists()) {
                    continue;
                }
                $book->reviews()->create([
                    'comment' => fake()->sentence(),
                    'rating' => fake()->numberBetween(1, 5),
                    'user_id' => $user->id,
                ]);
                $book->rating = $book->getAverageRating();
                $book->save();
            }
        }
    }
}
