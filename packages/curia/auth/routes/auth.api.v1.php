<?php

// All routes starts with "/api/v1/auth"

use Illuminate\Support\Facades\Route;
use Curia\Auth\UI\Api\V1\Controllers\LoginController;
use Curia\Auth\UI\Api\V1\Controllers\ProfileController;

Route::post('login', [LoginController::class, 'index']);

Route::middleware('auth:api')->group(function() {
    Route::get('me', [ProfileController::class, 'index']);
    Route::get('logout', [ProfileController::class, 'logout']);
});