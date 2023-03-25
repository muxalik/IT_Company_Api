<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $languages = Collection::times(mt_rand(1, 3), function() {
            return Str::upper(fake()->languageCode());
        });

        $discord = fake()->userName() . "#" . fake()->numerify('####');

        $years = fake()->optional(0.8, mt_rand(15, 25))->numberBetween(1, 10);
        $projects = $years * mt_rand(5, 17);
        $tasks = $projects * mt_rand(34, 87);

        return [
            'salary' => fake()->numberBetween(10000, 700000),
            'avatar' => 'images/' . fake()->md5() . '.jpg',
            'country' => fake()->country(),
            'city' => fake()->city(),
            'languages' => $languages->implode(', '),
            'phone' => fake()->phoneNumber(),
            'discord' => $discord,
            'tasks_done' => $tasks,
            'projects_done' => $projects,
            'wasted_years' => $years,
            'ip_address' => fake()->ipv4(),
            'created_at' => fake()->dateTimeBetween('-10 years', '-2 years'),
        ];
    }
}
