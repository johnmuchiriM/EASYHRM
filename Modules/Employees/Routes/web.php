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

Route::prefix('employees')->middleware('acl','auth')->group(function() {
    Route::get('/', 'EmployeesController@index')->name('admin.employees');
    Route::get('/create', 'EmployeesController@create')->name('admin.employee.create');
    Route::get('/edit/{id}', 'EmployeesController@edit')->name('admin.employee.edit');
    Route::post('/update/{id}', 'EmployeesController@update')->name('admin.employee.update');
    Route::post('/store', 'EmployeesController@store')->name('admin.employee.store');
    Route::post('/delete/{id}', 'EmployeesController@destroy')->name('admin.employee.destroy');
});
