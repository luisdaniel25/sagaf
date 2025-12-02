<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CriterioDeEvaluacion
 * 
 * @property int $Codigo
 * @property string $cri_Denominacion
 * @property string $cri_Observacion
 * @property int $Codigo_ra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ResultadoAprendizaje $resultado_aprendizaje
 *
 * @package App\Models
 */
class CriterioDeEvaluacion extends Model
{
	protected $table = 'tbl_criterio_de_evaluacions';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_ra' => 'int'
	];

	protected $fillable = [
		'cri_Denominacion',
		'cri_Observacion',
		'Codigo_ra'
	];

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_ra');
	}
}
