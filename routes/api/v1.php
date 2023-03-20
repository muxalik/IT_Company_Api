<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    '/users' => UserController::class,
    '/teams' => TeamController::class,    
]);