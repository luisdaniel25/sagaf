<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 * 
 * @property int $Codigo
 * @property int|null $inst_Identificacion
 * @property string $inst_TipoID
 * @property string $inst_Nombres
 * @property string $inst_Apellido
 * @property string $inst_Direccion
 * @property string $inst_Correo
 * @property string $inst_Telefono
 * @property int $Codigo_vigencia
 * @property int|null $Codigo_usuario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Collection|AsignacionesInstructore[] $asignaciones_instructores
 * @property Collection|DisponibilidadInstructore[] $disponibilidad_instructores
 * @property Collection|Evento[] $eventos
 * @property Collection|Competencia[] $competencias
 * @property Collection|Solicitud[] $solicituds
 *
 * @package App\Models
 */
class Instructor extends Model
{
	protected $table = 'tbl_instructors';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'inst_Identificacion' => 'int',
		'Codigo_vigencia' => 'int',
		'Codigo_usuario' => 'int'
	];

	protected $fillable = [
		'inst_Identificacion',
		'inst_TipoID',
		'inst_Nombres',
		'inst_Apellido',
		'inst_Direccion',
		'inst_Correo',
		'inst_Telefono',
		'Codigo_vigencia',
		'Codigo_usuario'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'Codigo_usuario');
	}

	public function asignaciones_instructores()
	{
		return $this->hasMany(AsignacionesInstructore::class, 'Codigo_instructor');
	}

	public function disponibilidad_instructores()
	{
		return $this->hasMany(DisponibilidadInstructore::class, 'Codigo_instructor');
	}

	public function eventos()
	{
		return $this->hasMany(Evento::class, 'Codigo_instructor');
	}

	public function competencias()
	{
		return $this->belongsToMany(Competencia::class, 'tbl_instructor_competencias', 'Codigo_instructor', 'Codigo_competencia')
					->withPivot('Codigo', 'hab_Estado', 'hab_FechaHabilitacion')
					->withTimestamps();
	}

	public function solicituds()
	{
		return $this->hasMany(Solicitud::class, 'Codigo_instructor');
	}
}
