<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FichaCaracterizacion
 * 
 * @property int $Codigo
 * @property Carbon $fich_Inicio
 * @property Carbon $fich_Fin
 * @property string $fich_Etapa
 * @property int $Codigo_modalidad
 * @property int $Codigo_programa
 * @property int $Codigo_centro
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CentroFormacion $centro_formacion
 * @property Modalidad $modalidad
 * @property Programa $programa
 * @property Collection|Aprendiz[] $aprendizs
 * @property Collection|AsignacionesInstructore[] $asignaciones_instructores
 * @property Collection|Evento[] $eventos
 * @property Collection|Solicitud[] $solicituds
 *
 * @package App\Models
 */
class FichaCaracterizacion extends Model
{
	protected $table = 'tbl_ficha_caracterizacions';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'fich_Inicio' => 'datetime',
		'fich_Fin' => 'datetime',
		'Codigo_modalidad' => 'int',
		'Codigo_programa' => 'int',
		'Codigo_centro' => 'int'
	];

	protected $fillable = [
		'fich_Inicio',
		'fich_Fin',
		'fich_Etapa',
		'Codigo_modalidad',
		'Codigo_programa',
		'Codigo_centro'
	];

	public function centro_formacion()
	{
		return $this->belongsTo(CentroFormacion::class, 'Codigo_centro');
	}

	public function modalidad()
	{
		return $this->belongsTo(Modalidad::class, 'Codigo_modalidad');
	}

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'Codigo_programa');
	}

	public function aprendizs()
	{
		return $this->hasMany(Aprendiz::class, 'Codigo_ficha');
	}

	public function asignaciones_instructores()
	{
		return $this->hasMany(AsignacionesInstructore::class, 'Codigo_ficha');
	}

	public function eventos()
	{
		return $this->hasMany(Evento::class, 'Codigo_ficha');
	}

	public function solicituds()
	{
		return $this->hasMany(Solicitud::class, 'Codigo_ficha');
	}
}
