<?php

// All routes starts with "/curia/download"

// Nova custom routes

use Curia\Download\UI\Web\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.web')->group(function() {
    // download file
    Route::get('start/{curiaDownload}/{collection}/{index}', [FilesController::class, 'download'])->name('start');
});