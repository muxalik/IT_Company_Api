<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Employee;
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
        
        Employee::all()->each(function ($employee) use ($teams) {
            $team = $teams->random();
            
            $startDate = $team->created_at->lte($employee->created_at) 
                ? $employee->created_at 
                : $team->created_at;

            $employee->teams()->attach($team, [
                'is_favourite' => fake()->boolean(33),
                'created_at' => fake()->dateTimeBetween($startDate),
            ]);
        });
        
    }
}
