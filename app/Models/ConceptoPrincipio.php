<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConceptoPrincipio
 * 
 * @property int $Codigo
 * @property string $con_Denominacion
 * @property string $con_Observacion
 * @property int $Codigo_resultado_aprendizaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ResultadoAprendizaje $resultado_aprendizaje
 *
 * @package App\Models
 */
class ConceptoPrincipio extends Model
{
	protected $table = 'tbl_concepto_principios';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_resultado_aprendizaje' => 'int'
	];

	protected $fillable = [
		'con_Denominacion',
		'con_Observacion',
		'Codigo_resultado_aprendizaje'
	];

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_resultado_aprendizaje');
	}
}
