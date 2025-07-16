<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        $wishlistEntries = [];

        foreach ($users as $user) {
            // Each user wishlists 2 to 8 random books
            $wishlistBooks = $books->random(rand(2, 8));



            foreach ($wishlistBooks as $book) {
                $wishlistExist = DB::table('wishlists')
                    ->where('user_id', $user->id)
                    ->where('book_id', $book->id)
                    ->exists();

                if ($wishlistExist) {
                    continue;
                }

                $wishlistEntries[] = [
                    'user_id'    => $user->id,
                    'book_id'    => $book->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 180)),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // Insert in batch
        DB::table('wishlists')->insert($wishlistEntries);
    }
}
