<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\UserCollection
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::with('projects', 'teams', 'leadingTeam', 'skills')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\User\StoreRequest  $request
     * @return App\Http\Resources\UserResource
     */
    public function store(StoreRequest $request): UserResource
    {
        return $this->userResponse(User::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return App\Http\Resources\UserResource
     */
    public function show(User $user): UserResource
    {
        return $this->userResponse($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\User\UpdateRequest  $request
     * @param  User  $user
     * @return App\Http\Resources\UserResource
     */
    public function update(UpdateRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return $this->userResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }

    public function userResponse(User $user): UserResource
    {
        return new UserResource($user->load('projects', 'teams', 'leadingTeam', 'skills'));
    }
}
