<?php

use App\Models\Skill;

it('gets all skills when they exist', function () {
    $skill = Skill::factory()->create();

    $this->getJson('/api/v1/skills')
        ->assertOk()
        ->assertExactJson([
            'data' => [[
                'id' => $skill->id,
                'name' => $skill->name,
                'users' => ['data' => []],
                'created_at' => $skill->created_at,
                'updated_at' => $skill->updated_at,
            ]]
        ]);
});

it('gets all skills when they does not exist', function () {
    $this->getJson('/api/v1/skills')
        ->assertOk()
        ->assertExactJson(['data' => []]);
});

it('gets one skill when it exists', function () {
    $skill = Skill::factory()->create();

    $this->getJson('/api/v1/skills/' . $skill->id)
        ->assertOk()
        ->assertExactJson([
            'data' => [
                'id' => $skill->id,
                'name' => $skill->name,
                'users' => ['data' => []],
                'created_at' => $skill->created_at,
                'updated_at' => $skill->updated_at,
            ]
        ]);
});

it('gets 404 when skill does not exist', function () {
    $this->getJson('/api/v1/skills/' . mt_rand(1, 10))
        ->assertStatus(404);
});

it('gets skill after creating', function () {
    $this->postJson('/api/v1/skills/', [
        'name' => 'Testing Name',
    ])->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'Testing Name',
                'users' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while creating', function () {
    $this->postJson('/api/v1/skills/', [
        'name' => '12',
    ])->assertStatus(422);
});

it('gets skill after updating', function () {
    $skill = Skill::factory()->create();

    $this->putJson('/api/v1/skills/' . $skill->id, [
        'name' => 'Testing Name',
    ])->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $skill->id,
                'name' => 'Testing Name',
                'users' => ['data' => []],
            ]
        ]);
});

it('gets 422 if validation error while updating', function () {
    $skill = Skill::factory()->create();

    $this->putJson('/api/v1/skills/' . $skill->id, [
        'name' => 'Too much characters here.............'
    ])->assertStatus(422);
});

it('gets no content after deleting', function () {
    $skill = Skill::factory()->create();

    $this->delete('/api/v1/skills/' . $skill->id)
        ->assertStatus(204);
});
