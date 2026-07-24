<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoCompetencia extends Model
{
    protected $table = 'tbl_tipo_competencias';

    protected $primaryKey = 'Codigo';

    public $timestamps = false;

    protected $fillable = [
        'tipo_Denominacion',
    ];

    public function competencias(): HasMany
    {
        return $this->hasMany(
            Competencia::class,
            'Codigo_tipo'
        );
    }

    public function scopePorNombre(
        $query,
        string $nombre
    )
    {
        return $query->where(
            'tipo_Denominacion',
            $nombre
        );
    }
}
