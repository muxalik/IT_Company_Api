<?php

use App\Models\Employee;
use App\Models\User;

function createEmployee(): Employee {
    return Employee::factory()->create([
        'user_id' => User::factory()->create()->id
    ]);
}

it('gets all employees when they exist', function () {
    $this->employee = createEmployee();

    $this->getJson('/api/v1/employees')
        ->assertOk()
        ->assertExactJson([
            'data' => [[
                'id' => $this->employee->id,
                'name' => $this->employee->name,
                'user_id' => $this->employee->user_id,
                'salary' => $this->employee->salary,
                'avatar' => $this->employee->avatar,
                'country' => $this->employee->country,
                'city' => $this->employee->city,
                'languages' => explode(', ', $this->employee->languages),
                'phone' => $this->employee->phone,
                'discord' => $this->employee->discord,
                'tasks_done' => $this->employee->tasks_done,
                'projects_done' => $this->employee->projects_done,
                'wasted_years' => $this->employee->wasted_years,
                'ip_address' => $this->employee->ip_address,
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
                'created_at' => $this->employee->created_at,
                'updated_at' => $this->employee->updated_at,
            ]]
        ]);
});

it('gets all employees when they do not exist', function () {
    $this->getJson('/api/v1/employees')
        ->assertOk()
        ->assertExactJson(['data' => []]);
});

it('gets one employee when it exists', function () {
    $this->employee = createEmployee();

    $this->getJson('/api/v1/employees/' . $this->employee->id)
        ->assertOk()
        ->assertExactJson([
            'data' => [
                'id' => $this->employee->id,
                'name' => $this->employee->name,
                'user_id' => $this->employee->user_id,
                'salary' => $this->employee->salary,
                'avatar' => $this->employee->avatar,
                'country' => $this->employee->country,
                'city' => $this->employee->city,
                'languages' => explode(', ', $this->employee->languages),
                'phone' => $this->employee->phone,
                'discord' => $this->employee->discord,
                'tasks_done' => $this->employee->tasks_done,
                'projects_done' => $this->employee->projects_done,
                'wasted_years' => $this->employee->wasted_years,
                'ip_address' => $this->employee->ip_address,
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
                'created_at' => $this->employee->created_at,
                'updated_at' => $this->employee->updated_at,
            ]
        ]);
});

it('gets 404 when employee does not exist', function () {
    $this->getJson('/api/v1/employee/' . mt_rand(1, 10))
        ->assertStatus(404);
});

it('gets employee after creating', function () {
    $this->postJson('/api/v1/employees/', [
        'name' => 'Emp Name',
        'salary' => 312515343,
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => 245,
        'projects_done' => 6,
        'wasted_years' => 5,
    ])->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'Emp Name',
                'salary' => 312515343,
                'country' => 'Russia',
                'city' => 'Moscow',
                'languages' => ['RU', 'EN', 'KZ'],
                'phone' => '88005553535',
                'discord' => 'gamer228#3145',
                'tasks_done' => 245,
                'projects_done' => 6,
                'wasted_years' => 5,
                'ip_address' => '127.0.0.1',
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while creating', function () {
    $this->postJson('/api/v1/employees/', [
        'name' => 'rejhg3g',
        'salary' => null,
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => ['RU', 'en', 'Kz'],
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => 245,
        'projects_done' => 6,
        'wasted_years' => 5,
    ])->assertStatus(422);
});

it('gets employee after updating', function () {
    $this->employee = createEmployee();

    $this->putJson('/api/v1/employees/' . $this->employee->id, [
        'name' => 'some name',
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
                'id' => $this->employee->id,
                'name' => 'some name',
                'user_id' => $this->employee->user_id,
                'salary' => 312515343,
                'country' => 'Russia',
                'city' => 'Moscow',
                'languages' => ['RU', 'EN', 'KZ'],
                'phone' => '88005553535',
                'discord' => 'gamer228#3145',
                'tasks_done' => 245,
                'projects_done' => 6,
                'wasted_years' => 5,
                'ip_address' => '127.0.0.1',
                'skills' => ['data' => []],
                'leading_team' => null,
                'teams' => ['data' => []],
                'projects' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while updating', function () {
    $this->employee = createEmployee();
    
    $this->putJson('/api/v1/employees/' . $this->employee->id, [
        'name' => 'nameemmememme',
        'salary' => '312515343',
        'country' => 'Russia',
        'city' => 'Moscow',
        'languages' => 'Russian language..',
        'phone' => '88005553535',
        'discord' => 'gamer228#3145',
        'tasks_done' => '245',
        'projects_done' => '6',
        'wasted_years' => '5',
    ])->assertStatus(422);
});

it('gets no content after deleting', function () {
    $this->employee = createEmployee();

    $this->delete('/api/v1/employees/' . $this->employee->id)
        ->assertStatus(204);
});