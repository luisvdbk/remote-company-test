<?php

use App\Http\Controllers\Admin\DownloadablesController;
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

Route::get('/admin', function () {
    return inertia('Admin/Dashboard');
});

Route::get('/admin/downloadables', [DownloadablesController::class, 'index'])->name('admin.downloadables.index');
Route::post('/admin/downloadables', [DownloadablesController::class, 'store'])->name('admin.downloadables.store');
Route::get('/admin/downloadables/create', [DownloadablesController::class, 'create'])->name('admin.downloadables.create');
Route::get('/admin/downloadables/edit', [DownloadablesController::class, 'edit'])->name('admin.downloadables.edit');
Route::put('/admin/downloadables', [DownloadablesController::class, 'update'])->name('admin.downloadables.update');
