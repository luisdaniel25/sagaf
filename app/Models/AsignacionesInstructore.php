<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsignacionesInstructore extends Model
{
    protected $table = 'tbl_asignaciones_instructores';

    protected $primaryKey = 'Codigo';

    public const ASIGNADO = 'Asignado';

    public const EN_CURSO = 'En curso';

    public const FINALIZADO = 'Finalizado';

    public const CANCELADO = 'Cancelado';

    protected $casts = [
        'Codigo_instructor' => 'integer',
        'Codigo_ficha' => 'integer',
        'Codigo_competencia' => 'integer',
        'Codigo_ambiente' => 'integer',
        'FechaAsignacion' => 'datetime',
    ];

    protected $fillable = [
        'Codigo_instructor',
        'Codigo_ficha',
        'Codigo_competencia',
        'Codigo_ambiente',
        'FechaAsignacion',
        'Estado',
        'Observaciones',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(
            Instructor::class,
            'Codigo_instructor'
        );
    }

    public function ficha_caracterizacion(): BelongsTo
    {
        return $this->belongsTo(
            FichaCaracterizacion::class,
            'Codigo_ficha'
        );
    }

    public function competencia(): BelongsTo
    {
        return $this->belongsTo(
            Competencia::class,
            'Codigo_competencia'
        );
    }

    public function ambiente(): BelongsTo
    {
        return $this->belongsTo(
            Ambiente::class,
            'Codigo_ambiente'
        );
    }

    public function notificaciones(): HasMany
    {
        return $this->hasMany(
            \Notificacione::class,
            'Codigo_asignacion'
        );
    }

    public function scopeAsignadas(
        Builder $query
    ): Builder {
        return $query->where(
            'Estado',
            self::ASIGNADO
        );
    }

    public function scopeEnCurso(
        Builder $query
    ): Builder {
        return $query->where(
            'Estado',
            self::EN_CURSO
        );
    }

    public function scopeFinalizadas(
        Builder $query
    ): Builder {
        return $query->where(
            'Estado',
            self::FINALIZADO
        );
    }

    public function scopeCanceladas(
        Builder $query
    ): Builder {
        return $query->where(
            'Estado',
            self::CANCELADO
        );
    }

    public function getEstaActivaAttribute(): bool
    {
        return in_array(
            $this->Estado,
            [
                self::ASIGNADO,
                self::EN_CURSO
            ],
            true
        );
    }
}
