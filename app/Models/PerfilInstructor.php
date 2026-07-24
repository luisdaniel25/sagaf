<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfilInstructor extends Model
{
    protected $table = 'tbl_perfil_instructors';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_programa' => 'integer',
    ];

    protected $fillable = [
        'per_RequisitosAcademicos',
        'per_Experiencia',
        'per_CompetenciasMinimas',
        'Codigo_programa',
    ];

    public function programa(): BelongsTo
    {
        return $this->belongsTo(
            Programa::class,
            'Codigo_programa'
        );
    }
}
