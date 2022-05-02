<?php

namespace App\Models;

use App\Models\Abonnement;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;


class Pack extends Model implements HasMedia
{
    use HasFactory,
    SoftDeletes,
    Notifiable,
    InteractsWithMedia;

    protected $fillable = [
        'libelle',
'description',
'montant',
    ];

    /**
     * Get all of the comments for the Pack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'abonnement_id', 'id');
    }
}
