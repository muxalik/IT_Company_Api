<?php

use App\Models\User;

it('gets all users when they exist', function () {
    $user = User::factory()->create();

    $this->getJson('/api/v1/users')
        ->assertOk()
        ->assertExactJson([
            'data' => [[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'salary' => "$user->salary",
                'avatar' => $user->avatar,
                'country' => $user->country,
                'city' => $user->city,
                'languages' => explode(', ', $user->languages),
                'phone' => $user->phone,
                'discord' => $user->discord,
                'tasks_done' => "$user->tasks_done",
                'projects_done' => "$user->projects_done",
                'wasted_years' => "$user->wasted_years",
                'ip_address' => $user->ip_address,
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]]
        ]);
});

it('gets all users when they does not exist', function () {
    $this->getJson('/api/v1/users')
        ->assertOk()
        ->assertExactJson(['data' => []]);
});

it('gets one user when it exists', function () {
    $user = User::factory()->create();

    $this->getJson('/api/v1/users/' . $user->id)
        ->assertOk()
        ->assertExactJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'salary' => "$user->salary",
                'avatar' => $user->avatar,
                'country' => $user->country,
                'city' => $user->city,
                'languages' => explode(', ', $user->languages),
                'phone' => $user->phone,
                'discord' => $user->discord,
                'tasks_done' => "$user->tasks_done",
                'projects_done' => "$user->projects_done",
                'wasted_years' => "$user->wasted_years",
                'ip_address' => $user->ip_address,
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
});

it('gets 404 when user does not exist', function () {
    $this->getJson('/api/v1/users/' . mt_rand(1, 10))
        ->assertStatus(404);
});

it('gets user after creating', function () {
    $this->postJson('/api/v1/users/', [
        'name' => 'Testing Name',
        'email' => 'testing@mail.com',
        'password' => 'Di13q%!gjjHG',
        'password_confirmation' => 'Di13q%!gjjHG',
        'salary' => '312515343',
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => '245',
        'projects_done' => '6',
        'wasted_years' => '5',
    ])->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'Testing Name',
                'email' => 'testing@mail.com',
                'salary' => '312515343',
                'country' => 'Russia',
                'city' => 'Moscow',
                'languages' => ['RU', 'EN', 'KZ'],
                'phone' => '88005553535',
                'discord' => 'gamer228#3145',
                'tasks_done' => '245',
                'projects_done' => '6',
                'wasted_years' => '5',
                'ip_address' => '127.0.0.1',
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while creating', function () {
    $this->postJson('/api/v1/users/', [
        'email' => 'testing@mail.com',
        'password' => 'Di13q%!gjjHG',
        'password_confirmation' => 'Di13q%!gjjHG',
        'salary' => '312515343',
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => '245',
        'projects_done' => '6',
        'wasted_years' => '5',
    ])->assertStatus(422);
});

it('gets user after updating', function () {
    $user = User::factory()->create();

    $this->putJson('/api/v1/users/' . $user->id, [
        'name' => 'Testing Name',
        'password' => 'Di13q%!gjjHG',
        'password_confirmation' => 'Di13q%!gjjHG',
        'salary' => '312515343',
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => '245',
        'projects_done' => '6',
        'wasted_years' => '5',
    ])->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => 'Testing Name',
                'email' => $user->email,
                'salary' => '312515343',
                'country' => 'Russia',
                'city' => 'Moscow',
                'languages' => ['RU', 'EN', 'KZ'],
                'phone' => '88005553535',
                'discord' => 'gamer228#3145',
                'tasks_done' => '245',
                'projects_done' => '6',
                'wasted_years' => '5',
                'ip_address' => '127.0.0.1',
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while updating', function () {
    $user = User::factory()->create();
    
    $this->putJson('/api/v1/users/' . $user->id, [
        'email' => 'testing@mail.com',
        'password' => 'Di13q%!gjjHG',
        'salary' => '312515343',
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => '245',
        'projects_done' => '6',
        'wasted_years' => '5',
    ])->assertStatus(422);
});

it('gets no content after deleting', function () {
    $user = User::factory()->create();

    $this->delete('/api/v1/users/' . $user->id)
        ->assertStatus(204);
});