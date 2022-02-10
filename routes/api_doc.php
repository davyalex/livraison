<?php

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

 //route pour creer un livreur(enregistrer un livreur)
Route::post('/livreur/store', 'App\Http\Controllers\LivreurController@store')->name('store');

Route::middleware(['auth:sanctum'])->group(function () {

//route pour afficher les information de base du livreur sur son dashboard
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

//route pour modifier ses informations sur son engin ====>(request->id): envoi de l'id du livreur connecté epuis le front-end;
    Route::post('/engin/update', 'App\Http\Controllers\EnginController@update')->name('engin.update');

});


/**
 * route infos profil du livreur
 */
Route::middleware(['auth:sanctum'])->group(function () {
    
//route pour afficher les information de l'engin du livreur  sur son dashboard
    Route::get('/profil/index', 'App\Http\Controllers\ProfilController@index')->name('profil.index');

//route pour ajouter des informations sur son profil
//====>name image de la photo profil(img_profil),
//====>name image de la photo piece-avant(img_piece_avant),
//====>name image de la photo piece-arriere(img_piece_arriere),
    Route::post('/profil/store', 'App\Http\Controllers\ProfilController@store')->name('profil.store');

//route pour modifier son profil ====>(request->id): envoi de l'id du livreur connecté depuis le front-end;
//====>name image de la photo profil(img_profil),
//====>name image de la photo piece-avant(img_piece_avant),
//====>name image de la photo piece-arriere(img_piece_arriere),
Route::post('/profil/update', 'App\Http\Controllers\ProfilController@update')->name('profil.update');
    
    });