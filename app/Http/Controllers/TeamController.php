<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\TeamResource;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TeamCollection(Team::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $this->teamResponse(Team::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return $this->teamResponse($team);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Team $team)
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
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->noContent();
    }

    public function teamResponse(Team $team)
    {
        return new TeamResource($team);
    }
}
