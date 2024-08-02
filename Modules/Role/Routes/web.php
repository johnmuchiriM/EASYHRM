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

Route::prefix('role')->middleware('auth','acl')->group(function() {
    Route::get('/', 'RoleController@index')->name('admin.role');
    Route::get('/create', 'RoleController@create')->name('admin.role.create');
    Route::get('/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
    Route::post('/update/{id}', 'RoleController@update')->name('admin.role.update');
    Route::post('/store', 'RoleController@store')->name('admin.role.store');
    Route::post('/delete/{id}', 'RoleController@destroy')->name('admin.role.destroy');
});
