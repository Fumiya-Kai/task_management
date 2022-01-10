<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::put('task/{taskId}', 'TaskController@update');
    Route::delete('task/{taskId}', 'TaskController@destroy');
});

// Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {
//     Route::middleware('api')->put('task/{taskId}', 'TaskController@update');
// });
