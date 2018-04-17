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
Route::post('/upload', ['as' => 'upload', 'uses' => 'UploadController@upload']);

/**
 * Units
 */
Route::post('/units', ['as' => 'units.store', 'uses' => 'UnitController@store']);
Route::put('/units/{unitId}', ['as' => 'units.update', 'uses' => 'UnitController@update']);
Route::post('/templates', ['as' => 'templates.store', 'uses' => 'TemplateController@store']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
