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
 */
class VwHorariosAprendice extends Model
{
	protected $table = 'vw_horarios_aprendices';
	public $incrementing = false;

	protected $casts = [
		'aprendiz_id' => 'int',
		'ficha_codigo' => 'int',
		'evento_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime'
	];

	protected $fillable = [
		'aprendiz_id',
		'apr_PrimerNombre',
		'apr_SegundoNombre',
		'apr_Apellidos',
		'apr_NumeroDocumento',
		'apr_CorreoSena',
		'ficha_codigo',
		'programa',
		'centro_formacion',
		'evento_id',
		'evento_titulo',
		'evento_descripcion',
		'fecha_inicio',
		'fecha_fin',
		'horaInicio',
		'horaFinal',
		'ambiente',
		'competencia',
		'instructor',
		'regional'
	];
}
