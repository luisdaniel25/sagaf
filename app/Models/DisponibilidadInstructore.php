<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisponibilidadInstructore extends Model
{
    protected $table = 'tbl_disponibilidad_instructores';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_instructor' => 'integer',
    ];

    protected $fillable = [
        'Codigo_instructor',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'dis_Estado',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(
            Instructor::class,
            'Codigo_instructor'
        );
    }

    public function scopeActivas($query)
    {
        return $query->where(
            'dis_Estado',
            'ACTIVO'
        );
    }
}
