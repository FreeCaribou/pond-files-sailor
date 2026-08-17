<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FolderController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home');

    Route::get('/folders/{folderId}', [FolderController::class, 'home'])->name('folder.home');

    Route::post('/folders', [FolderController::class, 'addFolder'])->name('folder.add');

    Route::post('/folders/{folderId}', [FolderController::class, 'addSubFolder'])->name('folder.addSub');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
