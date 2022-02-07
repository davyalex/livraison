<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Profil extends Model implements HasMedia
{
    use HasFactory,
    Notifiable,
    InteractsWithMedia;

    protected $fillable=[
        'type_piece',
        'livreur_id'
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


