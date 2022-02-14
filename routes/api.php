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



/**
 * Authentification
 */

 //route pour se connecter
 Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

 //route pour se deconnecter
     Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout')->middleware('auth:sanctum');
 
 
 
 
 /**
  * route pour livreur
  */
 
     //route pour afficher la liste des livreurs
 Route::get('/livreur/liste', 'App\Http\Controllers\LivreurController@liste')->name('livreur.liste');
 
  //route pour creer un livreur(enregistrer un livreur)
 Route::post('/livreur/store', 'App\Http\Controllers\LivreurController@store')->name('store');
 
 Route::middleware(['auth:sanctum'])->group(function () {
 
 //route pour afficher les information de base du livreur  sur son dashboard
     Route::get('/livreur/index', 'App\Http\Controllers\LivreurController@index')->name('index');
 
 //route pour ajouter sa position actuelle ====>(request->id): envoi de l'id du livreur connecté epuis le front-end;
     Route::post('/livreur/position', 'App\Http\Controllers\LivreurController@position')->name('position');
 
 //route pour modifier ses informations ====>(request->id): envoi de l'id du livreur connecté;
     Route::post('/livreur/update', 'App\Http\Controllers\LivreurController@update')->name('update');
 
 });
 
 
 
 /**
  * route infos engin du livreur
  */
 
 Route::middleware(['auth:sanctum'])->group(function () {
     
 //route pour afficher les information de l'engin du livreur  sur son dashboard
     Route::get('/engin/index', 'App\Http\Controllers\EnginController@index')->name('engin.index');
 
 //route pour certifier son engin
 //====>name image de la photo plaque(img_immatriculation)
     Route::post('/engin/store', 'App\Http\Controllers\EnginController@store')->name('engin.store');
 
 //route pour modifier ses informations sur son engin ====>(request->id): envoi de l'id de l'engin du livreur connecté epuis le front-end;
     Route::post('/engin/update', 'App\Http\Controllers\EnginController@update')->name('engin.update');
 
 });
 
 
 /**
  * route infos profil du livreur
  */
 Route::middleware(['auth:sanctum'])->group(function () {
   
    //route pour afficher la photo de profil du livreur  sur son dashboard
    Route::get('/profil/indexImageProfil', 'App\Http\Controllers\ProfilController@indexImageProfil')->name('profil.indexImageProfil');

 //route pour afficher les information sur la piece  du livreur  sur son dashboard
     Route::get('/profil/indexPiece', 'App\Http\Controllers\ProfilController@indexPiece')->name('profil.indexPiece');
 
 //route pour ajouter des informations de sa piece sur son profil
 //====>name image de la photo piece-avant(img_piece_avant),
 //====>name image de la photo piece-arriere(img_piece_arriere),
     Route::post('/profil/storePiece', 'App\Http\Controllers\ProfilController@storePiece')->name('profil.storePiece');
 
//route pour ajouter photo de profil 
//====>Id du livreur envoyé au back
//====>name image de la photo profil(img_profil),
     Route::post('/profil/storePhotoProfil', 'App\Http\Controllers\ProfilController@storePhotoProfil')->name('profil.storePhotoProfil');

 //route pour modifier sa photo profil ====>(request->id): envoi de l'id du livreur connecté depuis le front-end;
 //====>name image de la photo profil(img_profil),,
 Route::post('/profil/updatePhotoProfil', 'App\Http\Controllers\ProfilController@updatePhotoProfil')->name('profil.updatePhotoProfil');
     

 //route pour modifier les infos de la piece ====>(request->id): envoi de l'id du profil du livreur connecté depuis le front-end;
 //====>name image de la photo piece-avant(img_piece_avant),
 //====>name image de la photo piece-arriere(img_piece_arriere),
 Route::post('/profil/updatePiece', 'App\Http\Controllers\ProfilController@updatePiece')->name('profil.updatePiece');
     
     });








// //route authentification
// Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
// Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout')->middleware('auth:sanctum');




// //route pour livreur
// //route pour afficher la liste des livreurs

// Route::get('/livreur/liste', 'App\Http\Controllers\LivreurController@liste')->name('livreur.liste');
// Route::post('/livreur/store', 'App\Http\Controllers\LivreurController@store')->name('store');
// Route::middleware(['auth:sanctum'])->group(function () {
    
// Route::get('/livreur/index', 'App\Http\Controllers\LivreurController@index')->name('index');
// Route::post('/livreur/position', 'App\Http\Controllers\LivreurController@position')->name('position');
// Route::post('/livreur/update', 'App\Http\Controllers\LivreurController@update')->name('update');

// });





// //route infos engin du livreur
// Route::middleware(['auth:sanctum'])->group(function () {
    
// Route::get('/engin/index', 'App\Http\Controllers\EnginController@index')->name('engin.index');
// Route::post('/engin/store', 'App\Http\Controllers\EnginController@store')->name('engin.store');
// Route::post('/engin/update', 'App\Http\Controllers\EnginController@update')->name('engin.update');

// });


// //route infos profil
// Route::middleware(['auth:sanctum'])->group(function () {
    
//     Route::get('/profil/index', 'App\Http\Controllers\ProfilController@index')->name('profil.index');
//     Route::post('/profil/store', 'App\Http\Controllers\ProfilController@store')->name('profil.store');
//     Route::post('/profil/update', 'App\Http\Controllers\ProfilController@update')->name('profil.update');
    
//     });



    
