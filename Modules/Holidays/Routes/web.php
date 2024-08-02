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
Route::prefix('holidays')->middleware('auth')->group(function() {
    Route::get('/', 'HolidaysController@index')->name('holiday');
    Route::get('/edit/{id}', 'HolidaysController@edit')->name('holiday.edit');
    Route::post('/update', 'HolidaysController@update')->name('holiday.update');
    Route::post('/delete/{id}', 'HolidaysController@destroy')->name('holiday.delete');
    Route::get('/calendar','HolidayCalendarController@index')->name('holiday.calendar');
    Route::get('load/calendar','HolidayCalendarController@loadCalendar')->name('load.calendar');
});

