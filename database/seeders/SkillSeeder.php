<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = Skill::factory(27)->create();

        Employee::all()->each(function ($employee) use ($skills) {
            $skills = $skills->random(mt_rand(3, 12));

            $employee->skills()->attach($skills, [
                'is_primary' => fake()->boolean(75),
                'started_learning_in' => fake()->dateTimeBetween('-10 years', '-1 year')->format('Y')
            ]);
        });
    }
}
