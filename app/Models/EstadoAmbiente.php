<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoAmbiente extends Model
{
    protected $table = 'tbl_estado_ambientes';

    protected $primaryKey = 'Codigo';

    protected $fillable = [
        'est_Denominacion',
        'est_FichaTecnica',
    ];

    public function ambientes(): HasMany
    {
        return $this->hasMany(
            Ambiente::class,
            'Codigo_estado'
        );
    }

    public function scopePorNombre($query, string $nombre)
    {
        return $query->where(
            'est_Denominacion',
            $nombre
        );
    }
}
