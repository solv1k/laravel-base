<?php

// All routes starts with "/api/v1/base"

use Illuminate\Support\Facades\Route;

Route::get('test', fn () => response()->json(['message' => 'API is working.']));