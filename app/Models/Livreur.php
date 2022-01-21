<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
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
   ];
}
