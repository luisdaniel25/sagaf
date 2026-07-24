<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    protected $table = 'tbl_instructors';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'inst_Identificacion' => 'integer',
        'Codigo_vigencia' => 'integer',
        'Codigo_usuario' => 'integer',
    ];

    protected $fillable = [
        'inst_Identificacion',
        'inst_TipoID',
        'inst_Nombres',
        'inst_Apellido',
        'inst_Direccion',
        'inst_Correo',
        'inst_Telefono',
        'Codigo_vigencia',
        'Codigo_usuario',
    ];

    protected $appends = [
        'nombre_completo',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return trim(
            "{$this->inst_Nombres} {$this->inst_Apellido}"
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'Codigo_usuario'
        );
    }

    public function competencias(): BelongsToMany
    {
        return $this->belongsToMany(
            Competencia::class,
            'tbl_instructor_competencias',
            'Codigo_instructor',
            'Codigo_competencia'
        )
            ->withPivot([
                'Codigo',
                'hab_Estado',
                'hab_FechaHabilitacion'
            ])
            ->withTimestamps();
    }
}
