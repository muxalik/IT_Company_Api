<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $multiplier = rand(1, 10);
        $total_tasks = fake()->numberBetween('250', '500');
        $tasks_done = fake()->numberBetween('100', $total_tasks);
        $total_hours = $total_tasks * $multiplier;
        $wasted_hours = $tasks_done * $multiplier;

        return [
            'name' => ucfirst(fake()->word()),
            'team_id' => Team::inRandomOrder()->first()->id,
            'total_tasks' => $total_tasks,
            'tasks_done' => $tasks_done,
            'total_hours' => $total_hours,
            'wasted_hours' => $wasted_hours,
            'created_at' => fake()->dateTimeBetween('-10 years', '-2 years')
        ];
    }
}
