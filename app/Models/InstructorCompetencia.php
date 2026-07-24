<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorCompetencia extends Model
{
    protected $table = 'tbl_instructor_competencias';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_instructor' => 'integer',
        'Codigo_competencia' => 'integer',
        'hab_FechaHabilitacion' => 'datetime',
    ];

    protected $fillable = [
        'Codigo_instructor',
        'Codigo_competencia',
        'hab_Estado',
        'hab_FechaHabilitacion',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(
            Instructor::class,
            'Codigo_instructor'
        );
    }

    public function competencia(): BelongsTo
    {
        return $this->belongsTo(
            Competencia::class,
            'Codigo_competencia'
        );
    }

    public function scopeActivas($query)
    {
        return $query->where(
            'hab_Estado',
            'ACTIVO'
        );
    }
}
