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

    Route::controller('PropertyController')->group(function () {
        Route::get('property-index', 'propertyIndex')->name('property.index');
        Route::get('property-create', 'propertyCreate')->name('property.create');
        Route::post('property-store', 'propertyStore')->name('property.store');
        Route::get('property-view/{id}', 'propertyView')->name('property.view');
        Route::get('property-details/{id}', 'propertyDetails')->name('property.details');
        Route::post('property-update', 'propertyUpdate')->name('property.update');
        Route::get('property-delete/{id}', 'propertyDelete')->name('property.delete');

        Route::post('property-update-thumbnail', 'updateThumbnail')->name('property.update.thumbnail');
        Route::post('property-update-multi-image', 'updateMultiImage')->name('property.update.multi.image');
        Route::get('property-update-multi-delete/{id}', 'multiImageDelete')->name('property.update.multi.delete');
        Route::post('property-store-new-multi-image', 'storeNewMultiImage')->name('property.store.new.multi.image');
        Route::post('property-update-facilites', 'updateFacilites')->name('property.update.facilites');

        Route::post('property-inactive', 'inactiveProperty')->name('property.inactive');
        Route::post('property-active', 'activeProperty')->name('property.active');
    });

    Route::controller('ManageAgentControlller')->group(function () {
        Route::get('all-agent', 'index')->name('all.agent');
        Route::get('add-agent', 'addAgent')->name('add.agent');
        Route::post('store-agent', 'storeAgent')->name('store.agent');
        Route::get('edit-agent/{id}', 'editAgent')->name('edit.agent');
        Route::post('update-agent/{id}', 'updateAgent')->name('update.agent');
        Route::get('delete-agent/{id}', 'deleteAgent')->name('delete.agent');

        Route::get('agent-change-status', 'changestatus')->name('agent.change.status');
    });
});
