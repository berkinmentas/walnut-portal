<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CallbackLogController;
use App\Http\Controllers\Admin\IncomingLogController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', AdminUserController::class);
        Route::post('/users/datatable', [AdminUserController::class, 'datatable'])->name('users.datatable');

        Route::resource('incomingLogs', IncomingLogController::class)->only(['index', 'show']);
        Route::post('/incomingLogs/datatable', [IncomingLogController::class, 'datatable'])->name('incoming-logs.datatable');

        Route::resource('callbackLogs', CallbackLogController::class)->only(['index', 'show']);
        Route::post('/callbackLogs/datatable', [CallbackLogController::class, 'datatable'])->name('callback-logs.datatable');

        // Resource routes
        // Route::resource('admin-users', AdminUserController::class);
        // Route::resource('incoming-logs', IncomingLogController::class);
        // Route::resource('incoming-log-data', IncomingLogDataController::class);
        // Route::resource('callback-logs', CallbackLogController::class);
    });

});
