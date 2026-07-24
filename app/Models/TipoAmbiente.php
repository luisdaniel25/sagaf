<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoAmbiente extends Model
{
    protected $table = 'tbl_tipo_ambientes';

    protected $primaryKey = 'Codigo';

    protected $fillable = [
        'tip_Denominacion',
    ];

    public function ambientes(): HasMany
    {
        return $this->hasMany(
            Ambiente::class,
            'Codigo_tipo'
        );
    }

    public function scopePorNombre(
        $query,
        string $nombre
    )
    {
        return $query->where(
            'tip_Denominacion',
            $nombre
        );
    }
}
