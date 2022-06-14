<?php

use App\Http\Controllers\Admin\DownloadablesController as AdminDownloadablesController;
use App\Http\Controllers\DownloadablesController;
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
});


