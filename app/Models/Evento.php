<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    protected $table = 'tbl_eventos';

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'Codigo_resultado_aprendizaje' => 'integer',
        'Codigo_instructor' => 'integer',
        'Codigo_ficha' => 'integer',
        'Codigo_ambiente' => 'integer',
        'Codigo_competencia' => 'integer',
    ];

    protected $fillable = [
        'title',
        'descripcion',
        'color',
        'start',
        'end',
        'Codigo_resultado_aprendizaje',
        'Codigo_instructor',
        'Codigo_ficha',
        'Codigo_ambiente',
        'Codigo_competencia',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'Codigo_instructor');
    }

    public function scopeFuturos($query)
    {
        return $query->where('start', '>=', now());
    }
}
