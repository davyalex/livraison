<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Livreur extends Authenticatable implements HasMedia
{

   use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;
   
   protected $fillable = [
    'nom',
    'prenom',
    'contact',
    'lieu_de_residence',
    'position_actuelle',
    'position_precise',
    'engin',
    'disponibilite',
    'status',
    'matricule',
    'password'
   ];


    /**
     * Get the user associated with the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

     /**
     * Get the user associated with the Profil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function engin()
    {
        return $this->hasOne(Engin::class);
    }
}
