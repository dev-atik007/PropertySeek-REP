<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


// Admin Auth
Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
    });
});



// admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('logout', 'logout')->name('logout');
    });
});
