<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::whereNot('name', 'Admin')->pluck('name');

        User::factory(50)->create()->each(function ($user) use ($roles) {
            if (fake()->boolean(25)) {
                $user->assignRole(fake()->randomElement($roles));
            }
        });

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'Admin@mail.com',
            'password' => bcrypt('secret-password'),
            'salary' => '999999',
            'country' => fake()->country(),
            'city' => fake()->city(),
            'languages' => 'EN',
            'tasks_done' => '99999',
            'projects_done' => '99999',
            'wasted_years' => '99999',
            'ip_address' => fake()->ipv4(),
            'created_at' => fake()->dateTimeBetween('-10 years', '-2 years'),
        ]);

        $admin->assignRole('Admin');
    }
}
