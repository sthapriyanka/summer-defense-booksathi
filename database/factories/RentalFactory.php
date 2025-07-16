<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Rental::class;

    public function definition()
    {
        return [
            'user_id'   => User::factory(),
            'book_id'   => Book::factory(),
            'penalty'   => 0,
            'rented_at' => now()->subDays(5),
            'due_date'  => now()->addDays(2),
            'status'    => 'rented',
        ];
    }
}
