<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->catchPhrase(),
            'author' => $this->faker->name,
            'isbn' => $this->faker->unique()->isbn13,
            'description' => $this->faker->realText(200),
            'publication_date' => $this->faker->date(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'language' => 'English','Nepali','French','Japanese','Hindi',
            'rating' => $this->faker->numberBetween(0, 5),
            'publisher' => $this->faker->company,
            'cover_image' => $this->faker->imageUrl(300, 400, 'books', true),
            'rental_price_per_week' => $this->faker->randomFloat(2, 1, 20),
            'total_copies' => $copies = $this->faker->numberBetween(1, 10),
            'available_copies' => $copies,
            'is_featured' => $this->faker->boolean(20),
            'status' => $this->faker->randomElement(['active', 'inactive', 'rental']),
        ];
    }


}
