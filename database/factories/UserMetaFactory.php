<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserMeta>
 */
class UserMetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thumbnail' => fake()->image(),
            'phone' => fake()->randomDigit(),
            'address' => fake()->address(), 
            'role' => fake()->randomElement(['user', 'staff', 'manager', 'admin']),
            'user_id' => 1
        ];
    }
}
