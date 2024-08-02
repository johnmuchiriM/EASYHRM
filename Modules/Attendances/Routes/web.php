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

Route::prefix('attendances')->middleware('auth')->group(function() {
    Route::get('/', 'AttendancesController@index')->name('attendances');
    Route::get('/loggedin', 'AttendancesController@loggedIn')->name('attendance.employee.loggedin');
    Route::get('/loggedout', 'AttendancesController@loggedOut')->name('attendance.employee.loggedout');
    Route::get('/get', 'AttendancesController@getAttendances')->name('attendance.get');
    Route::get('/logs', 'AttendanceLogController@index')->name('attendance.logs');
    Route::get('/getlogs', 'AttendanceLogController@getAttendanceLog')->name('attendance.getLogs');


});


