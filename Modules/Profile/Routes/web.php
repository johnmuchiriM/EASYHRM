<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('profile')->middleware('auth')->group(function() {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::post('/update',  'ProfileController@update')->name('profile.update');

    //forgot-password controller
    Route::get('/change/password', 'ChangePasswordController@index')->name('profile.index');
    Route::post('/change/password',  'ChangePasswordController@changePassword')->name('profile.change.password');

});
