<?php

namespace App\Models;

use App\Models\Abonnement;
// use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Livreur extends Authenticatable implements HasMedia
{

   use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia,SoftDeletes;
   
   protected $fillable = [
    'nom',
    'prenom',
    'contact',
    'lieu_de_residence',
    'position_actuelle',
    'disponibilite',
    'position_precise',
    'engin',
    'status',
    'quartier',
    'password',
    'nombre_de_vue'
    // 'matricule',
   ];

   protected $casts = [
    'disponibilite'=>'array',
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

     /**
     * Get all of the comments for the Pack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }
}
