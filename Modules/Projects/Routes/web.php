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

Route::prefix('projects')->middleware('auth')->group(function() {
    Route::get('/', 'ProjectsController@index')->name('admin.projects');
    Route::get('/edit/{id}', 'ProjectsController@edit')->name('admin.project.edit');
    Route::post('/update/{id}', 'ProjectsController@update')->name('admin.project.update');
    Route::post('/store', 'ProjectsController@store')->name('admin.project.store');
    Route::post('/delete/{id}', 'ProjectsController@destroy')->name('admin.project.destroy');
    Route::get('/completed/project', 'ProjectsController@completedProject')->name('admin.completed.project');
    Route::post('/update/project/status', 'ProjectsController@updateProjectStatus')->name('admin.update.project.status');
});