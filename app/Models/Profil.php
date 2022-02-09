<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model implements HasMedia
{
    use HasFactory,
    Notifiable,
    InteractsWithMedia;

    protected $fillable=[
        'type_piece',
        'livreur_id',
        'numero_piece'
    ];

   /**
    * Get the livreur that owns the Profil
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function livreur()
   {
       return $this->belongsTo(Livreur::class);
   }


}


