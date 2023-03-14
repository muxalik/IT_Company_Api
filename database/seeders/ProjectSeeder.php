<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory(21)->create()->each(function ($project) {
            $users = User::inRandomOrder()->take(rand(4, 10))->get();
            $users_count = $users->count();

            $users->each(function ($user) use ($project, $users_count) {
                $total_tasks = $project->total_tasks / $users_count;
                $total_hours = rand(3, $project->total_hours / $users_count);
                $divider = rand(2, 5);
                $startDate = $project->created_at->lte($user->created_at)
                    ? $user->created_at
                    : $project->created_at;

                $project->users()->attach($user, [
                    'is_favourite' => fake()->boolean(30),
                    'total_tasks' => $total_tasks,
                    'tasks_done' => $total_tasks / $divider,
                    'total_hours' => $total_hours,
                    'wasted_hours' => $total_hours / $divider,
                    'created_at' => fake()->dateTimeBetween($startDate, '-2 years')
                ]);
            });
        });
    }
}
