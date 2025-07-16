<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(WishlistSeeder::class);
        $this->call(RentalSeeder::class);
        $this->call(RentalPenaltyAndExtensionSeeder::class);

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'role' => 'admin',
        // ]);
        // User::factory()->create([
        //     'name' => 'Jerry',
        //     'email' => 'jerry@jerry.com',
        //     'role' => 'user',
        // ]);

        // $genreNames = [
        //     'Fiction', 'Non-Fiction', 'Mystery', 'Science Fiction', 'Fantasy',
        //     'Biography', 'Romance', 'Thriller', 'Horror', 'Historical',
        //     'Self-Help', 'Graphic Novel', 'Poetry', 'Young Adult', 'Children',
        // ];

        // $genres = collect($genreNames)->map(function ($name) {
        //     return Genre::create(['name' => $name]);
        // });

        // // Create some users for review purposes
        // $users = User::factory(10)->create();

        // // Create books and link genres + reviews
        // Book::factory(50)->create()->each(function ($book) use ($genres, $users) {
        //     // Attach 1–3 genres
        //     $book->genres()->attach(
        //         $genres->random(rand(1, 3))->pluck('id')->toArray()
        //     );

        //     // Create 2–5 reviews for the book
        //     $reviewers = $users->random(rand(2, 5));
        //     foreach ($reviewers as $user) {
        //         $review = Review::factory()->make();
        //         $book->reviews()->create([
        //             'user_id' => $user->id,
        //             'rating' => $review->rating,
        //             'comment' => $review->comment,
        //         ]);
        //     }

        //     // Update book rating as average of review ratings
        //     $averageRating = round($book->reviews()->avg('rating'));
        //     $book->update(['rating' => $averageRating]);
        // });
    }
}
