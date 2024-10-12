<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\RoomsClassificationController;

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
    Route::get('blogs/get_pending_blogs',
        [BlogsController::class, 'get_pending_blogs'])
         ->name('get_pending_blogs')->middleware('permission:manager blogs');
    Route::get('blogs/preview_blogs/{id}', [BlogsController::class, 'preview_blogs'])
         ->name('blogs.preview_blogs')->middleware('permission:manager blogs');
//? BLOGS CONTROLLER
    // Resource route cho BlogsController, kiểm tra quyền truy cập
    Route::group(['middleware' => ['auth']], function () {
        // Route cho quyền 'add blogs' với phương thức 'GET' cho 'create' và 'POST' cho 'store'
        Route::get('/blogs/index', [BlogsController::class, 'index'])
             ->name('blogs.index')->middleware('permission:all blogs');
        Route::get('/blogs/myblogs', [BlogsController::class, 'myblogs'])
             ->name('blogs.myblogs')->middleware('permission:view my blogs');
        Route::get('blogs/create', [BlogsController::class, 'create'])
             ->name('blogs.create')->middleware('permission:add blogs');
        Route::post('/admin/blogs', [BlogsController::class, 'store'])
             ->name('blogs.store')->middleware('permission:add blogs');

        // Route cho quyền 'edit blogs' với phương thức 'GET' cho 'edit' và 'PUT/PATCH' cho 'update'
        Route::get('blogs/{blog}/edit', [BlogsController::class, 'edit'])
             ->name('blogs.edit')->middleware('permission:edit blogs');
        Route::put('blogs/{blog}', [BlogsController::class, 'update'])
             ->name('blogs.update')->middleware('permission:edit blogs');
        Route::patch('blogs/{blog}', [BlogsController::class, 'update'])
             ->name('blogs.update')->middleware('permission:edit blogs');

        // Route cho quyền 'delete blogs' với phương thức 'DELETE'
        Route::delete('blogs/{blog}',
            [BlogsController::class, 'destroy'])->name('blogs.destroy')
             ->middleware('permission:delete blogs');
    });
//? END BLOGS CONTROLLER
// manager rooms_classification
    Route::resource('/rooms_classification', RoomsClassificationController::class)
         ->names('rooms_classification')->middleware('permission:manager rooms_classification');
// END manager rooms_classification

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
