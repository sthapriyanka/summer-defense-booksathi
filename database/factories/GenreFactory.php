<?php

namespace Database\Factories;

use App\Models\genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = genre::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->word()),
        ];
    }
}
