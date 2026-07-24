<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regionale extends Model
{
    protected $table = 'tbl_regionales';

    protected $primaryKey = 'Codigo';

    protected $fillable = [
        'reg_Denominacion',
    ];

    public function aprendices(): HasMany
    {
        return $this->hasMany(
            Aprendiz::class,
            'Codigo_regional'
        );
    }

    public function centrosFormacion(): HasMany
    {
        return $this->hasMany(
            CentroFormacion::class,
            'Codigo_regional'
        );
    }

    public function scopePorNombre(
        $query,
        string $nombre
    )
    {
        return $query->where(
            'reg_Denominacion',
            $nombre
        );
    }
}
