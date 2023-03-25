<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\ProjectCollection
     */
    public function index(): ProjectCollection
    {
        return new ProjectCollection(Project::with('users', 'team')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Project\StoreRequest  $request
     * @return App\Http\Resources\ProjectResource
     */
    public function store(StoreRequest $request): ProjectResource
    {
        return $this->projectResponse(Project::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return App\Http\Resources\ProjectResource
     */
    public function show(Project $project): ProjectResource
    {
        return $this->projectResponse($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Project\UpdateRequest  $request
     * @param  Project  $project
     * @return App\Http\Resources\ProjectResource
     */
    public function update(UpdateRequest $request, Project $project): ProjectResource
    {
        $project->update($request->validated());

        return $this->projectResponse($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project): Response
    {
        $project->delele();

        return response()->noContent();
    }

    public function projectResponse(Project $project): ProjectResource
    {
        return new ProjectResource($project->load('users', 'team'));
    }
}
