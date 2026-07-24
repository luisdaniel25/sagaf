<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConceptoPrincipio extends Model
{
    protected $table = 'tbl_concepto_principios';

    protected $primaryKey = 'Codigo';

    protected $keyType = 'int';

    public $incrementing = true;

    protected $casts = [
        'Codigo_resultado_aprendizaje' => 'integer',
    ];

    protected $fillable = [
        'con_Denominacion',
        'con_Observacion',
        'Codigo_resultado_aprendizaje',
    ];

    public function resultadoAprendizaje(): BelongsTo
    {
        return $this->belongsTo(
            ResultadoAprendizaje::class,
            'Codigo_resultado_aprendizaje'
        );
    }

    public function scopePorResultado($query, int $resultadoId)
    {
        return $query->where(
            'Codigo_resultado_aprendizaje',
            $resultadoId
        );
    }
}
