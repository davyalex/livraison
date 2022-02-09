<?php

namespace App\Models;

use App\Models\Livreur;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Engin extends Model implements HasMedia
{
    use HasFactory,
    Notifiable,
    InteractsWithMedia;

    protected $fillable = [
        'type_engin',
        'immatriculation',
        'livreur_id'
    ];

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
 
}
