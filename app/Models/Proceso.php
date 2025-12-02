<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proceso
 * 
 * @property int $Codigo
 * @property string $pro_Denominacion
 * @property string $pro_Observacion
 * @property int $Codigo_ra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ResultadoAprendizaje $resultado_aprendizaje
 *
 * @package App\Models
 */
class Proceso extends Model
{
	protected $table = 'tbl_procesos';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_ra' => 'int'
	];

	protected $fillable = [
		'pro_Denominacion',
		'pro_Observacion',
		'Codigo_ra'
	];

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_ra');
	}
}
