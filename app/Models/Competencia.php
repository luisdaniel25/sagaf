<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table = 'tbl_competencias';

    protected $primaryKey = 'comp_codigoCompetencia';

    protected $keyType = 'int';

    public $incrementing = true;

    public function programa(): BelongsTo
    {
        return $this->belongsTo(
            Programa::class,
            'Codigo_programa'
        );
    }

    public function tipoCompetencia(): BelongsTo
    {
        return $this->belongsTo(
            TipoCompetencia::class,
            'Codigo_tipo'
        );
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(
            Instructor::class,
            'tbl_instructor_competencias',
            'Codigo_competencia',
            'Codigo_instructor'
        )
            ->withPivot([
                'Codigo',
                'hab_Estado',
                'hab_FechaHabilitacion'
            ])
            ->withTimestamps();
    }

    public function scopeActivas($query)
    {
        return $query->whereNotNull(
            'Codigo_programa'
        );
    }
}
