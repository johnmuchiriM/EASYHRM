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

Route::prefix('dashboard')->middleware('auth')->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/attendance', 'DashboardController@employeesAttendance')->name('dashboard.attendance');
    Route::get('/employee/{id}', 'DashboardEmployeeController@index')->name('dashboard.employee');
});

