<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckPermissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users')->middleware(CheckPermissionMiddleware::class);
Route::resource('/dashboard/roles', RoleController::class)->middleware(CheckPermissionMiddleware::class);
Route::resource('/dashboard/permission', PermissionController::class)->middleware(CheckPermissionMiddleware::class);

//Role Access

Route::get('/dashboard/permission-role/{role_id}', [PermissionController::class, 'permission_role'])->name('permission_role.index')->middleware(CheckPermissionMiddleware::class);
Route::post('/dashboard/permisison-role/{role_id}', [PermissionController::class, 'permission_role_update'])->name('permission_role.update')->middleware(CheckPermissionMiddleware::class);



require __DIR__ . '/auth.php';
