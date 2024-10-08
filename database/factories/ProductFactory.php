<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text($maxNbChars = 50),
            'image' => fake()->image(),
            'price' => fake()->randomDigit(),
            'quantity' => fake()->randomDigit(),
            'status' => fake()->randomElement(['sold', 'available']),
            'view' => fake()->randomDigit(),
            'category_id' => 1,
        ];
    }
}
