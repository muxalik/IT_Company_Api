<?php

use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
        '/employees' => EmployeeController::class,
        '/teams' => TeamController::class,    
        '/projects' => ProjectController::class,
        '/skills' => SkillController::class,
    ]);
    
});