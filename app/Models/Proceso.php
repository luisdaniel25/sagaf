<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proceso extends Model
{
    protected $table = 'tbl_procesos';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_ra' => 'integer',
    ];

    protected $fillable = [
        'pro_Denominacion',
        'pro_Observacion',
        'Codigo_ra',
    ];

    public function resultadoAprendizaje(): BelongsTo
    {
        return $this->belongsTo(
            ResultadoAprendizaje::class,
            'Codigo_ra'
        );
    }

    public function scopePorResultado($query, int $resultadoId)
    {
        return $query->where(
            'Codigo_ra',
            $resultadoId
        );
    }
}
