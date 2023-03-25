<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Team\StoreRequest;
use App\Http\Requests\Api\Team\UpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\TeamCollection
     */
    public function index(): TeamCollection
    {
        return new TeamCollection(Team::with('users', 'leader', 'projects')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Team\StoreRequest  $request
     * @return App\Http\Resources\TeamResource
     */
    public function store(StoreRequest $request): TeamResource
    {
        return $this->teamResponse(Team::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Team  $team
     * @return App\Http\Resources\TeamResource
     */
    public function show(Team $team): TeamResource
    {
        return $this->teamResponse($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Team\UpdateRequest  $request
     * @param  Team  $team
     * @return App\Http\Resources\TeamResource
     */
    public function update(UpdateRequest $request, Team $team): TeamResource
    {
        $team->update($request->validated());

        return $this->teamResponse($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team): Response
    {
        $team->delete();

        return response()->noContent();
    }

    public function teamResponse(Team $team): TeamResource
    {
        return new TeamResource($team->load('users', 'leader', 'projects'));
    }
}
