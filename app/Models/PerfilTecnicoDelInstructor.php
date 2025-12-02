<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilTecnicoDelInstructor
 * 
 * @property int $Codigo
 * @property string $per_RequisitosAcademicos
 * @property string $per_Experiencia
 * @property string $per_CompetenciasMinimas
 * @property string $per_Observacion
 * @property int $Codigo_ra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ResultadoAprendizaje $resultado_aprendizaje
 *
 * @package App\Models
 */
class PerfilTecnicoDelInstructor extends Model
{
	protected $table = 'tbl_perfil_tecnico_del_instructors';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_ra' => 'int'
	];

	protected $fillable = [
		'per_RequisitosAcademicos',
		'per_Experiencia',
		'per_CompetenciasMinimas',
		'per_Observacion',
		'Codigo_ra'
	];

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_ra');
	}
}
