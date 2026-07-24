<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ambiente extends Model
{
    protected $table = 'tbl_ambientes';

    protected $primaryKey = 'Codigo';

    protected $keyType = 'int';

    public $incrementing = true;

    protected $casts = [
        'amb_Cupo' => 'integer',
        'Codigo_tipo' => 'integer',
        'Codigo_estado' => 'integer',
    ];

    protected $fillable = [
        'amb_Denominacion',
        'amb_Cupo',
        'Codigo_tipo',
        'Codigo_estado',
    ];

    public function estadoAmbiente(): BelongsTo
    {
        return $this->belongsTo(
            EstadoAmbiente::class,
            'Codigo_estado'
        );
    }

    public function tipoAmbiente(): BelongsTo
    {
        return $this->belongsTo(
            TipoAmbiente::class,
            'Codigo_tipo'
        );
    }

    public function asignacionesInstructores(): HasMany
    {
        return $this->hasMany(
            AsignacionesInstructore::class,
            'Codigo_ambiente'
        );
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(
            Evento::class,
            'Codigo_ambiente'
        );
    }

    public function scopeActivos($query)
    {
        return $query->where(
            'Codigo_estado',
            1
        );
    }
}
