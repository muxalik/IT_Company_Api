<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProjectCollection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $this->projectResponse(Project::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $this->projectResponse($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Project $project)
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
        return new ProjectResource($project);
    }
}
