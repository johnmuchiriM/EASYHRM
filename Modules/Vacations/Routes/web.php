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

Route::prefix('vacations')->middleware('auth')->group(function() {
    Route::get('/' ,'VacationsController@index')->name('vacations');
    Route::get('/create', 'VacationsController@create')->name('vacations.create');
    Route::get('/edit/{id}', 'VacationsController@edit')->name('vacations.edit');
    Route::post('/store', 'VacationsController@store')->name('vacations.store');
    Route::post('/delete/{id}', 'VacationsController@destroy')->name('vacations.destroy');

    
});

Route::prefix('approve/vacation')->middleware('auth','acl')->group(function() {
    Route::get('/status' ,'VacationsApprovalStatusController@index')->name('vacations.approval');
    Route::post('update/status', 'VacationsApprovalStatusController@updateStatus')->name('vacations.status.updateStatus');
    Route::get('/status/edit/{id}', 'VacationsApprovalStatusController@edit')->name('vacations.status.edit');
    Route::post('/status/delete/{id}', 'VacationsApprovalStatusController@destroy')->name('vacations.status.destroy');
});

Route::prefix('allocate')->middleware('auth','acl')->group(function() {
    Route::get('/leave' ,'AllocateLeaveController@index')->name('allocate.leave');
    Route::get('/leave/edit/{id}', 'AllocateLeaveController@edit')->name('allocate.leave.edit');
    Route::post('/leave/update', 'AllocateLeaveController@update')->name('allocate.leave.update');
    Route::post('/leave/delete/{id}', 'AllocateLeaveController@destroy')->name('allocate.leave.destroy');
});