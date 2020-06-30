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
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
// Route::get('/logout', 'UserController@logout')->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/detail', 'UserController@detail');
    Route::get('/logout', 'UserController@logout');
});

Route::middleware('auth:api')->group( function() {
    Route::resource('services', 'API\ServiceController');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
