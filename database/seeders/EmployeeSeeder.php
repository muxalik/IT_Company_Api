<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Default'])->pluck('name');

        User::all()->each(function ($user) use ($roles) {
            Employee::factory()->create([
                'user_id' => $user->id,
            ]);

            $user->assignRole(fake()->boolean(25)
                ? fake()->randomElement($roles)
                : Role::where('name', 'Default')->first());
        });
    }
}
