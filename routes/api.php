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





//route pour livreur
Route::post('/store', 'App\Http\Controllers\LivreurController@store')->name('store');
Route::post('/update', 'App\Http\Controllers\LivreurController@update')->name('update')->middleware('auth:sanctum');
Route::post('/auth', 'App\Http\Controllers\LivreurController@auth')->name('auth')->middleware('auth:sanctum');




//route authentification
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout')->middleware('auth:sanctum');


