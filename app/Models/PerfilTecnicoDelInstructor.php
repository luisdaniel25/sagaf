<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerfilTecnicoDelInstructor extends Model
{
    protected $table = 'tbl_perfil_tecnico_del_instructors';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_ra' => 'integer',
    ];

    protected $fillable = [
        'per_RequisitosAcademicos',
        'per_Experiencia',
        'per_CompetenciasMinimas',
        'per_Observacion',
        'Codigo_ra',
    ];

    public function resultadoAprendizaje(): BelongsTo
    {
        return $this->belongsTo(
            ResultadoAprendizaje::class,
            'Codigo_ra'
        );
    }
}
