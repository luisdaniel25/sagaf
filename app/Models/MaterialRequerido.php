<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MaterialRequerido
 * 
 * @property int $Codigo
 * @property string $mat_Denominacion
 * @property string $mat_Observacion
 * @property int $Codigo_ra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ResultadoAprendizaje $resultado_aprendizaje
 *
 * @package App\Models
 */
class MaterialRequerido extends Model
{
	protected $table = 'tbl_material_requeridos';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_ra' => 'int'
	];

	protected $fillable = [
		'mat_Denominacion',
		'mat_Observacion',
		'Codigo_ra'
	];

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_ra');
	}
}
