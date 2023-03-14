<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::factory(12)->create();
        
        User::all()->each(function ($user) use ($teams) {
            $team = $teams->random();
            $startDate = $team->created_at->lte($user->created_at) 
                ? $user->created_at 
                : $team->created_at;

            $user->teams()->attach($team, [
                'is_favourite' => fake()->boolean(33),
                'created_at' => fake()->dateTimeBetween($startDate),
            ]);
        });
        
    }
}
