<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vigencia extends Model
{
    protected $table = 'tbl_vigencias';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'vig_Contrato' => 'integer',
        'vig_anio' => 'integer',
        'vig_Inicio' => 'datetime',
        'vig_Fin' => 'datetime',
        'Codigo_red' => 'integer',
    ];

    protected $fillable = [
        'vig_Contrato',
        'vig_anio',
        'vig_Inicio',
        'vig_Fin',
        'vig_Objetos',
        'Codigo_red',
    ];

    public function rede(): BelongsTo
    {
        return $this->belongsTo(
            Rede::class,
            'Codigo_red'
        );
    }
}
