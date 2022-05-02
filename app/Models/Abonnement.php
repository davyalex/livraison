<?php

namespace App\Models;

use App\Models\Pack;
use App\Models\Livreur;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Abonnement extends Model implements HasMedia
{
    use HasFactory,
    SoftDeletes,
    Notifiable,
    InteractsWithMedia;


    protected $fillable = [
        'durée',
        'tva',
        'montant_ttc',
        'date_debut',
        'date_fin',
        'livreur_id',
        'pack_id',
    ];

        public function livreur(){
            return $this->belongsTo(Livreur::class,'livreur_id');
        }

        public function pack(){
            return $this->belongsTo(Pack::class,'pack_id');
        }


}
