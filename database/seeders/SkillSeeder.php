<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
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

        User::all()->each(function ($user) use ($skills) {
            $skills = $skills->random(mt_rand(3, 12));

            $user->skills()->attach($skills, [
                'is_primary' => fake()->boolean(75),
                'started_learning_in' => fake()->dateTimeBetween('-10 years', '-1 year')->format('Y')
            ]);
        });
    }
}
