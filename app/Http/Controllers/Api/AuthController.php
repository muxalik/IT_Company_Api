<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $defaultRole = Role::where('name', 'Default')->first();
        $user->assignRole($defaultRole);
        $permissions = $defaultRole->permissions->pluck('name')->toArray();
        $authToken = $user->createToken('auth-token', $permissions)->plainTextToken;

        return response()->json([
            'access_token' => $authToken
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ],
                ],
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $roles = $user->roles;
        $perms = $roles->map(fn($role) => $role->permissions->pluck('name'))->toArray();

        $authToken = $user->createToken('auth-token', $perms)->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }
}
