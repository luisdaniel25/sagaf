<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FichaCaracterizacion extends Model
{
    protected $table = 'tbl_ficha_caracterizacions';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'fich_Inicio' => 'datetime',
        'fich_Fin' => 'datetime',
        'Codigo_modalidad' => 'integer',
        'Codigo_programa' => 'integer',
        'Codigo_centro' => 'integer',
    ];

    protected $fillable = [
        'fich_Inicio',
        'fich_Fin',
        'fich_Etapa',
        'Codigo_modalidad',
        'Codigo_programa',
        'Codigo_centro',
    ];

    public function programa(): BelongsTo
    {
        return $this->belongsTo(
            Programa::class,
            'Codigo_programa'
        );
    }

    public function aprendices(): HasMany
    {
        return $this->hasMany(
            Aprendiz::class,
            'Codigo_ficha'
        );
    }

    public function scopeActivas($query)
    {
        return $query->where('fich_Fin', '>=', now());
    }
}
