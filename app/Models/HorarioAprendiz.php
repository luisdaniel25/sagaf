<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioAprendiz extends Model
{
    protected $table = 'vw_horarios_aprendices';

    public $timestamps = false;

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'aprendiz_id',
        'apr_PrimerNombre',
        'apr_SegundoNombre',
        'apr_Apellidos',
        'apr_NumeroDocumento',
        'apr_CorreoSena',
        'ficha_codigo',
        'programa',
        'centro_formacion',
        'evento_id',
        'evento_titulo',
        'evento_descripcion',
        'fecha_inicio',
        'fecha_fin',
        'horaInicio',
        'horaFinal',
        'ambiente',
        'competencia',
        'instructor',
        'regional'
    ];

    // Scope para buscar por documento del aprendiz
    public function scopePorDocumento($query, $documento)
    {
        return $query->where('apr_NumeroDocumento', $documento);
    }

    // Scope para eventos de esta semana
    public function scopeEstaSemana($query)
    {
        return $query->whereBetween('fecha_inicio', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    // Scope para eventos futuros
    public function scopeFuturos($query)
    {
        return $query->where('fecha_inicio', '>=', now());
    }
}
