<?php

use App\Http\Controllers\Admin\DownloadablesController as AdminDownloadablesController;
use App\Http\Controllers\Admin\SnippetsController as AdminSnippetsController;
use App\Http\Controllers\DownloadablesController;
use App\Http\Controllers\SnippetsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return inertia('App/Dashboard');
});

Route::get('/downloadables', [DownloadablesController::class, 'index'])->name('downloadables.index');

Route::get('/snippets', [SnippetsController::class, 'index'])->name('snippets.index');
Route::get('/snippets/{snippet}', [SnippetsController::class, 'show'])->name('snippets.show');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return inertia('Admin/Dashboard');
    });

    Route::get('/downloadables', [AdminDownloadablesController::class, 'index'])->name('admin.downloadables.index');
    Route::post('/downloadables', [AdminDownloadablesController::class, 'store'])->name('admin.downloadables.store');
    Route::get('/downloadables/create', [AdminDownloadablesController::class, 'create'])->name('admin.downloadables.create');
    Route::get('/downloadables/{downloadable}/edit', [AdminDownloadablesController::class, 'edit'])->name('admin.downloadables.edit');
    Route::put('/downloadables/{downloadable}', [AdminDownloadablesController::class, 'update'])->name('admin.downloadables.update');
    Route::delete('/downloadables/{downloadable}', [AdminDownloadablesController::class, 'destroy'])->name('admin.downloadables.destroy');

    Route::get('/snippets', [AdminSnippetsController::class, 'index'])->name('admin.snippets.index');
    Route::post('/snippets', [AdminSnippetsController::class, 'store'])->name('admin.snippets.store');
    Route::get('/snippets/create', [AdminSnippetsController::class, 'create'])->name('admin.snippets.create');
    Route::get('/snippets/{snippet}/edit', [AdminSnippetsController::class, 'edit'])->name('admin.snippets.edit');
    Route::put('/snippets/{snippet}', [AdminSnippetsController::class, 'update'])->name('admin.snippets.update');
    Route::delete('/snippets/{snippet}', [AdminSnippetsController::class, 'destroy'])->name('admin.snippets.destroy');
});


