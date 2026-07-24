<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwHorariosAprendice
 *
 * @property int $aprendiz_id
 * @property string $apr_PrimerNombre
 * @property string|null $apr_SegundoNombre
 * @property string $apr_Apellidos
 * @property string $apr_NumeroDocumento
 * @property string|null $apr_CorreoSena
 * @property int $ficha_codigo
 * @property string $programa
 * @property string $centro_formacion
 * @property int|null $evento_id
 * @property string|null $evento_titulo
 * @property string|null $evento_descripcion
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property string|null $horaInicio
 * @property string|null $horaFinal
 * @property string|null $ambiente
 * @property string|null $competencia
 * @property string|null $instructor
 * @property string $regional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */class VwHorariosAprendice extends Model
{
    protected $table = 'vw_horarios_aprendices';

    public $incrementing = false;

    public $timestamps = false;

    protected $hidden = [
        'apr_NumeroDocumento',
        'apr_CorreoSena',
    ];

    protected $casts = [
        'aprendiz_id' => 'integer',
        'ficha_codigo' => 'integer',
        'evento_id' => 'integer',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function scopePorAprendiz($query, int $aprendizId)
    {
        return $query->where(
            'aprendiz_id',
            $aprendizId
        );
    }
}
