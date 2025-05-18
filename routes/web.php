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

require __DIR__.'/auth.php';
