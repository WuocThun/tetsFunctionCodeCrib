<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BlogsController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->name("admin.")->group(function () {
    Route::get("/", [AdminController::class, 'index'])->name('index');
    Route::get("/addRole", [PermissionController::class, 'index'])
         ->name('addRole')->middleware('role:admin');
    Route::post('/permissions/{user}/assign-role',
        [PermissionController::class, 'assignRole'])->name('assignRole')
         ->middleware('role:admin');
    Route::post('/permissions/{user}/revoke-role',
        [PermissionController::class, 'revokeRole'])->name('revokeRole')
         ->middleware('role:admin');
    Route::resource('/blogs', BlogsController::class)->names('blogs');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
