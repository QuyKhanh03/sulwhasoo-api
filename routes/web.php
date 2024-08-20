<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'check.access'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //account
    Route::match(['get', 'post'], '/account', [UserController::class, 'account'])->name('user.account');

    //permissions
    Route::get('get-permissions', [PermissionController::class, 'getPermissions'])->name('get.permissions')->middleware('permission:view permission');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:view permission');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:create permission');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create permission');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit permission');
    Route::patch('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:edit permission');
    Route::delete('/permissions/{permission}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete permission');

    //roles
    Route::get('get-roles', [RoleController::class, 'getRole'])->name('get.roles')->middleware('permission:view role');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view role');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create role');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create role');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit role');
    Route::patch('/roles/{role}/update', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit role');
    Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role');

    //users
    Route::get('get-users', [UserController::class, 'getUsers'])->name('get.users')->middleware('permission:view user');
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:view user');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create user');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('permission:create user');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit user');
    Route::patch('/users/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit user');
    Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete user');
    //

    //categories
    Route::get('get-categories', [CategoryController::class, 'getCategories'])->name('get.categories');
    Route::get('get-all-categories', [CategoryController::class, 'getAllCategories'])->name('get.all.categories');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

