<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CentroFormacion extends Model
{
    protected $table = 'tbl_centro_formacions';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_regional' => 'integer',
    ];

    protected $fillable = [
        'cent_Denominacion',
        'Codigo_regional',
    ];

    public function regionale(): BelongsTo
    {
        return $this->belongsTo(
            Regionale::class,
            'Codigo_regional'
        );
    }

    public function aprendices(): HasMany
    {
        return $this->hasMany(
            Aprendiz::class,
            'Codigo_centro'
        );
    }

    public function fichasCaracterizacion(): HasMany
    {
        return $this->hasMany(
            FichaCaracterizacion::class,
            'Codigo_centro'
        );
    }

    public function scopeRegional($query, int $regionalId)
    {
        return $query->where(
            'Codigo_regional',
            $regionalId
        );
    }
}
