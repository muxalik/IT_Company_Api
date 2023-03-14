<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst(fake()->words(2, true)),
            'description' => fake()->sentence(),
            'leader_id' => User::inRandomOrder()->first()->id,
            'created_at' => fake()->dateTimeBetween('-10 years', '-5 years'),
        ];
    }
}
