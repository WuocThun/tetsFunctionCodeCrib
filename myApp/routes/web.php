<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BlogsController;

Route::get('/', function () {
    return view('welcome');
});
// Route group với middleware 'auth' và tiền tố 'admin'
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Route cho quản lý vai trò, chỉ cho phép người dùng có quyền quản lý vai trò
    Route::get("/", [AdminController::class, 'index'])->name('index');
//Phân quyền đành cho ADMIN
    Route::get('/addRole', [PermissionController::class, 'getAssgin'])
         ->name('addRole')->middleware('permission:create role');
    Route::get('/allUser', [PermissionController::class, 'getAllUser'])
         ->name('allUser')->middleware('permission:create role');
    Route::get('/getAssgin/{id}', [PermissionController::class, 'assgin'])
         ->name('assgin')->middleware('permission:assign role');
    Route::post('/insert_roles/{id}',
        [PermissionController::class, 'insert_roles'])
         ->name('insert_roles')->middleware('permission:assign role');
    Route::get('/permission/{id}', [PermissionController::class, 'permission'])
         ->name('permission')->middleware('permission:assign role');
    Route::post('/insert_permission/{id}',
        [PermissionController::class, 'insert_permission'])
         ->name('insert_permission')->middleware('permission:assign role');
    Route::post('/insert_permission',
        [PermissionController::class, 'add_permisission'])
         ->name('add_permisission')->middleware('permission:assign role');
    Route::resource('/createUser', PermissionController::class)
         ->names('user')->middleware('permission:create role');
    Route::post('/permissions/{user}/assign-role',
        [PermissionController::class, 'assignRole'])
         ->name('assignRole')
         ->middleware('permission:assign role');
    Route::post('/permissions/{user}/revoke-role',
        [PermissionController::class, 'revokeRole'])
         ->name('revokeRole')
         ->middleware('permission:revoke role');

    // Resource route cho BlogsController, kiểm tra quyền truy cập
    Route::resource('/blogs', BlogsController::class)
         ->names('blogs')
         ->middleware('permission:add blogs|edit blogs|delete blogs|publish blogs',
             [
                 'only' => [
                     'index',
                     'show',
                 ],
             ]); // Kiểm tra quyền cho tất cả các route của blogs
});

//Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
//    Route::get("/", [AdminController::class, 'index'])->name('index');
//    Route::get("/addRole", [PermissionController::class, 'index'])->name('addRole');
//    Route::post('/permissions/{user}/assign-role', [PermissionController::class, 'assignRole'])->name('assignRole');
//    Route::post('/permissions/{user}/revoke-role', [PermissionController::class, 'revokeRole'])->name('revokeRole');
//
//    // Resource route cho BlogsController
//});

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
