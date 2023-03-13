<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create()->each(function ($user) {
            $skills = Skill::inRandomOrder()->take(rand(3, 13))->pluck('id');

            $user->skills()->attach($skills, [
                'is_primary' => fake()->boolean(75),
                'started_learning_in' => fake()->dateTimeBetween('-10 years', '-1 year')->format('Y')
            ]);
        });
    }
}
