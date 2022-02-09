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



//route authentification
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout')->middleware('auth:sanctum');




//route pour livreur
Route::post('/livreur/store', 'App\Http\Controllers\LivreurController@store')->name('store');
Route::post('/livreur/index', 'App\Http\Controllers\LivreurController@index')->name('index');
Route::middleware(['auth:sanctum'])->group(function () {

Route::post('/livreur/position', 'App\Http\Controllers\LivreurController@position')->name('position');
Route::post('/livreur/update', 'App\Http\Controllers\LivreurController@update')->name('update');
// Route::post('/auth', 'App\Http\Controllers\LivreurController@auth')->name('auth')->middleware('auth:sanctum');

});



//route infos engin du livreur
Route::middleware(['auth:sanctum'])->group(function () {
    
Route::get('/engin/index', 'App\Http\Controllers\EnginController@index')->name('engin.index');
Route::post('/engin/store', 'App\Http\Controllers\EnginController@store')->name('engin.store');
Route::post('/engin/update', 'App\Http\Controllers\EnginController@update')->name('engin.update');

});


//route infos profil
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/profil/index', 'App\Http\Controllers\ProfilController@index')->name('profil.index');
    Route::post('/profil/store', 'App\Http\Controllers\ProfilController@store')->name('profil.store');
    Route::post('/profil/update', 'App\Http\Controllers\ProfilController@update')->name('profil.update');
    
    });
