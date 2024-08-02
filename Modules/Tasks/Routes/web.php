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

Route::prefix('tasks')->middleware('auth')->group(function() {
    Route::get('/', 'TasksController@index')->name('admin.tasks');
    Route::get('/create', 'TasksController@create')->name('admin.task.create');
    Route::get('/edit/{tid}', 'TasksController@edit')->name('admin.task.edit');
    Route::post('/update/{id}', 'TasksController@update')->name('admin.task.update');
    Route::post('/store', 'TasksController@store')->name('admin.task.store');
    Route::post('/delete/{id}', 'TasksController@destroy')->name('admin.task.destroy');
    Route::get('/history/{taskid}', 'TasksController@viewtaskhistory')->name('admin.task.history');
    Route::get('/get/task/data', 'TasksController@gettaskdata')->name('admin.task.get');
    Route::get('/completed/task', 'TasksController@completedtask')->name('admin.completed.task');
    Route::post('/task/update/status', 'TasksController@taskUpdateStatus')->name('admin.task.update.status');
});

Route::prefix('my-task')->middleware('auth')->group(function() {
    Route::get('/', 'MyTasksController@index')->name('task.mytasks');
    Route::get('/get', 'MyTasksController@get')->name('task.get');
    Route::get('/start', 'MyTasksController@taskstart')->name('task.start');
    Route::get('/stop', 'MyTasksController@taskstop')->name('task.stop');
    Route::post('/completed', 'MyTasksController@taskcompleted')->name('task.completed');
    Route::get('/completed/list', 'MyTasksController@completedtask')->name('task.completed.list');
    Route::get('/details/{taskid}', 'MyTasksController@taskdetails')->name('task.details');
    Route::post('/add-comment', 'MyTasksController@addcomment')->name('task.mytask.comment');
    Route::get('/edit/{id}', 'MyTasksController@edit')->name('task.edit');
    Route::get('/history/{taskid}', 'MyTasksController@taskhistory')->name('task.mytask.history');
    Route::post('/history/{taskid}', 'MyTasksController@updatetaskhistory')->name('task.mytask.history.update');
    Route::post('/task/update/my/status', 'MyTasksController@taskUpdateMyStatus')->name('task.update.my.status');
});
