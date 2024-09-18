<?php

use Illuminate\Support\Facades\Route;





// admin group middleware
Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::controller('AgentController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
});
