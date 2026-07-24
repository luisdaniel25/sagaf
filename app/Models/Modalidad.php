<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modalidad extends Model
{
    protected $table = 'tbl_modalidads';

    protected $fillable = [
        'mod_Denominacion',
    ];

    public function fichasCaracterizacion(): HasMany
    {
        return $this->hasMany(
            FichaCaracterizacion::class,
            'Codigo_modalidad'
        );
    }

    public function scopePorNombre($query, string $nombre)
    {
        return $query->where(
            'mod_Denominacion',
            $nombre
        );
    }
}
