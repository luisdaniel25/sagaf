<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultadoAprendizaje
 * 
 * @property int $Codigo
 * @property string $resul_Denominacion
 * @property int $Codigo_competencias
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Competencia $competencia
 * @property Collection|ConceptoPrincipio[] $concepto_principios
 * @property Collection|CriterioDeEvaluacion[] $criterio_de_evaluacions
 * @property Collection|Evento[] $eventos
 * @property Collection|MaterialRequerido[] $material_requeridos
 * @property Collection|PerfilTecnicoDelInstructor[] $perfil_tecnico_del_instructors
 * @property Collection|Proceso[] $procesos
 *
 * @package App\Models
 */
class ResultadoAprendizaje extends Model
{
	protected $table = 'tbl_resultado_aprendizajes';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_competencias' => 'int'
	];

	protected $fillable = [
		'resul_Denominacion',
		'Codigo_competencias'
	];

	public function competencia()
	{
		return $this->belongsTo(Competencia::class, 'Codigo_competencias');
	}

	public function concepto_principios()
	{
		return $this->hasMany(ConceptoPrincipio::class, 'Codigo_resultado_aprendizaje');
	}

	public function criterio_de_evaluacions()
	{
		return $this->hasMany(CriterioDeEvaluacion::class, 'Codigo_ra');
	}

	public function eventos()
	{
		return $this->hasMany(Evento::class, 'Codigo_resultado_aprendizaje');
	}

	public function material_requeridos()
	{
		return $this->hasMany(MaterialRequerido::class, 'Codigo_ra');
	}

	public function perfil_tecnico_del_instructors()
	{
		return $this->hasMany(PerfilTecnicoDelInstructor::class, 'Codigo_ra');
	}

	public function procesos()
	{
		return $this->hasMany(Proceso::class, 'Codigo_ra');
	}
}
