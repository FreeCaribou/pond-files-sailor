<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home');

    Route::get('/folders/{folderId}', [FolderController::class, 'home'])->name('folder.home');

    Route::post('/folders', [FolderController::class, 'add'])->name('folder.add');

    Route::post('/folders/{folderId}/folders', [FolderController::class, 'addSubFolder'])->name('folder.addSub');

    Route::post('/files', [FileController::class, 'add'])->name('file.add');

    Route::post('/folders/{folderId}/files', [FileController::class, 'addInFolder'])->name('file.addInFolder');

    Route::get('/files/{folderId}/download', [FileController::class, 'download'])->name('file.download');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
