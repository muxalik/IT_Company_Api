<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Project;
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
            $employees = Employee::inRandomOrder()->take(mt_rand(4, 10))->get();
            $employees_count = $employees->count();

            $employees->each(function ($employee) use ($project, $employees_count) {
                $total_tasks = $project->total_tasks / $employees_count;
                $total_hours = mt_rand(3, $project->total_hours / $employees_count);
                $divider = mt_rand(2, 5);
                $startDate = $project->created_at->lte($employee->created_at)
                    ? $employee->created_at
                    : $project->created_at;

                $project->employees()->attach($employee, [
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
