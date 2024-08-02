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

Route::prefix('configurations')->middleware('auth','acl')->group(function() {
    Route::get('/', 'ConfigurationsController@index')->name('configurations.index');
    Route::post('/save', 'ConfigurationsController@store')->name('configurations.save');
});
