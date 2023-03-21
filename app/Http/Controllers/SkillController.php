<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skill\StoreRequest;
use App\Http\Requests\Skill\UpdateRequest;
use App\Http\Resources\SkillCollection;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Response;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): SkillCollection
    {
        return new SkillCollection(Skill::with('users')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Skill\StoreRequest  $request
     * @return App\Http\Resources\SkillResource
     */
    public function store(StoreRequest $request): SkillResource
    {
        return $this->skillResponse(Skill::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Skill  $skill
     * @return App\Http\Resources\SkillResource
     */
    public function show(Skill $skill): SkillResource
    {
        return $this->skillResponse($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Skill\UpdateRequest  $request
     * @param  Skill  $skill
     * @return App\Http\Resources\SkillResource
     */
    public function update(UpdateRequest $request, Skill $skill): SkillResource
    {
        $skill->update($request->validated());

        return $this->skillResponse($skill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill): Response
    {
        $skill->delete();

        return response()->noContent();
    }

    public function skillResponse(Skill $skill): SkillResource
    {
        return new SkillResource($skill->load('users'));
    }
}
