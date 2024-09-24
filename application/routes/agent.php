<?php

use Illuminate\Support\Facades\Route;





// admin group middleware
Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::controller('AgentController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile-update', 'profileUpdate')->name('profile.update');
        Route::get('security', 'security')->name('security');
        Route::post('security-update', 'securityUpdate')->name('security.update');

        Route::get('logout', 'logout')->name('logout');
        

    });
});






Route::controller('AgentController')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
});
