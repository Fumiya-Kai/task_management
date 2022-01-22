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

Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return redirect()->route('target.index');
    });
    Route::resource('target', 'TargetController');
    Route::resource('report', 'ReportController');
    Route::resource('calendar', 'CalendarController');

    // Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
    //     Route::put('task/{taskId}', 'TaskController@update');
    // });
});
