<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Competencia
 * 
 * @property int $comp_codigoCompetencia
 * @property string|null $comp_Denominacion
 * @property string $comp_VersionNCl
 * @property string $comp_DuracionEstimada
 * @property int $comp_Creditos
 * @property int $comp_Horas_FI
 * @property string $comp_Tipo
 * @property int|null $Codigo_programa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $Codigo_tipo
 * 
 * @property Programa|null $programa
 * @property TipoCompetencia|null $tipo_competencia
 * @property Collection|AsignacionesInstructore[] $asignaciones_instructores
 * @property Collection|Evento[] $eventos
 * @property Collection|Instructor[] $instructors
 * @property Collection|ResultadoAprendizaje[] $resultado_aprendizajes
 * @property Collection|Solicitud[] $solicituds
 *
 * @package App\Models
 */
class Competencia extends Model
{
	protected $table = 'tbl_competencias';
	protected $primaryKey = 'comp_codigoCompetencia';

	protected $casts = [
		'comp_Creditos' => 'int',
		'comp_Horas_FI' => 'int',
		'Codigo_programa' => 'int',
		'Codigo_tipo' => 'int'
	];

	protected $fillable = [
		'comp_Denominacion',
		'comp_VersionNCl',
		'comp_DuracionEstimada',
		'comp_Creditos',
		'comp_Horas_FI',
		'comp_Tipo',
		'Codigo_programa',
		'Codigo_tipo'
	];

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'Codigo_programa');
	}

	public function tipo_competencia()
	{
		return $this->belongsTo(TipoCompetencia::class, 'Codigo_tipo');
	}

	public function asignaciones_instructores()
	{
		return $this->hasMany(AsignacionesInstructore::class, 'Codigo_competencia');
	}

	public function eventos()
	{
		return $this->hasMany(Evento::class, 'Codigo_competencia');
	}

	public function instructors()
	{
		return $this->belongsToMany(Instructor::class, 'tbl_instructor_competencias', 'Codigo_competencia', 'Codigo_instructor')
					->withPivot('Codigo', 'hab_Estado', 'hab_FechaHabilitacion')
					->withTimestamps();
	}

	public function resultado_aprendizajes()
	{
		return $this->hasMany(ResultadoAprendizaje::class, 'Codigo_competencias');
	}

	public function solicituds()
	{
		return $this->hasMany(Solicitud::class, 'Codigo_competencia');
	}
}
