<?php


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
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile-update', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password-update', 'passwordUpdate')->name('password.update');

    });

    Route::controller('PropertyTypeController')->group(function () {
        Route::get('all-type', 'allType')->name('all.type');
        Route::get('add-proerty-type', 'addType')->name('add.property.type');
        Route::post('store-proerty-type', 'storeType')->name('store.property.type');
        Route::get('edit-proerty-type/{id}', 'editType')->name('edit.property.type');
        Route::post('update-proerty-type/{id}', 'updateType')->name('update.property.type');
        Route::get('delete-proerty-type/{id}', 'deleteType')->name('delete.property.type');

    });

    Route::controller('AmenitiesController')->group(function () {
        Route::get('all-amenities', 'index')->name('index.amenities');
        Route::get('add-amenities', 'addAminites')->name('add.amenities');
        Route::post('store-amenities', 'storeAminites')->name('store.amenities');
        Route::get('edit-amenities/{id}', 'editAminites')->name('edit.amenities');
        Route::post('update-amenities/{id}', 'updateAminites')->name('update.amenities');
        Route::get('delete-amenities/{id}', 'deleteAminites')->name('delete.amenities');
    });
});
