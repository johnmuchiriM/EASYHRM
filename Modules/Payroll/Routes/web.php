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

Route::prefix('payroll')->middleware('auth')->group(function() {
    Route::get('/', 'PayrollController@index')->name('payroll');
    Route::get('/create', 'PayrollController@create')->name('payroll.create');
    Route::post('/store', 'PayrollController@store')->name('payroll.store');
    Route::get('/edit/{id}', 'PayrollController@edit')->name('payroll.edit');
    Route::post('/update/{id}', 'PayrollController@update')->name('payroll.update');
    Route::post('/destroy/{id}', 'PayrollController@destroy')->name('payroll.destroy');
    Route::get('/get/{id}', 'PayrollController@getData')->name('payroll.get');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/salary-slip', 'SalarySlipController@index')->name('salary.slip');
    Route::get('/salary-slip/view/{id}', 'SalarySlipController@view')->name('salary.slip.view');
    Route::get('/download/salary-slip/{id}', 'SalarySlipController@downloadSalarySlip')->name('salary.download');
});

