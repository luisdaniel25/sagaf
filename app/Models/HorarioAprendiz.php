<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class HorarioAprendiz extends Model
{
    protected $table = 'vw_horarios_aprendices';

    public $timestamps = false;

    protected $guarded = [];

    public function scopePorDocumento(
        Builder $query,
        string $documento
    ): Builder
    {
        return $query->where(
            'apr_NumeroDocumento',
            $documento
        );
    }

    public function scopeEstaSemana(
        Builder $query
    ): Builder
    {
        return $query->whereBetween(
            'fecha_inicio',
            [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]
        );
    }

    public function scopeFuturos(
        Builder $query
    ): Builder
    {
        return $query->where(
            'fecha_inicio',
            '>=',
            now()
        );
    }
}
