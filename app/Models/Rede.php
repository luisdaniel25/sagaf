<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rede extends Model
{
    protected $table = 'tbl_redes';

    protected $primaryKey = 'Codigo';

    protected $fillable = [
        'red_Denominacion',
    ];

    public function especialidades(): HasMany
    {
        return $this->hasMany(
            Especialidade::class,
            'Codigo_red'
        );
    }

    public function vigencias(): HasMany
    {
        return $this->hasMany(
            Vigencia::class,
            'Codigo_red'
        );
    }

    public function scopePorNombre(
        $query,
        string $nombre
    )
    {
        return $query->where(
            'red_Denominacion',
            $nombre
        );
    }
}
