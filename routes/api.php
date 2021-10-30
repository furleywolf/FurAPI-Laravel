<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::apiResource("v1/getPic",\App\Http\Controllers\API\GetPicController::class);
Route::get('v1/getPic/{type?}/{class?}', '\App\Http\Controllers\API\GetPicController@index');
Route::post('v1/putPic/{class?}', '\App\Http\Controllers\API\PutPicController@index');

