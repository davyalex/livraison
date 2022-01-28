<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Livreur extends Authenticatable
{

   use HasApiTokens, HasFactory, Notifiable;
   
   protected $fillable = [
    'nom',
    'prenom',
    'contact',
    'lieu_de_residence',
    'position_actuelle',
    'engin',
    'disponibilite',
    'status',
    'matricule',
    'password'
   ];
}
