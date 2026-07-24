<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Especialidade extends Model
{
    protected $table = 'tbl_especialidades';

    protected $primaryKey = 'Codigo';

    protected $keyType = 'int';

    public $incrementing = true;

    protected $casts = [
        'Codigo_red' => 'integer',
    ];

    protected $fillable = [
        'esp_Denominacion',
        'Codigo_red',
    ];

    public function rede(): BelongsTo
    {
        return $this->belongsTo(
            Rede::class,
            'Codigo_red'
        );
    }

    public function scopePorRed($query, int $redId)
    {
        return $query->where(
            'Codigo_red',
            $redId
        );
    }
}
