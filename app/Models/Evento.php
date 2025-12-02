<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evento
 * 
 * @property int $id
 * @property string $title
 * @property string $descripcion
 * @property string|null $color
 * @property Carbon $start
 * @property Carbon $end
 * @property string $horaInicio
 * @property string $horaFinal
 * @property int|null $Codigo_resultado_aprendizaje
 * @property int|null $Codigo_instructor
 * @property int|null $Codigo_ficha
 * @property int|null $Codigo_ambiente
 * @property int|null $Codigo_competencia
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Ambiente|null $ambiente
 * @property Competencia|null $competencia
 * @property FichaCaracterizacion|null $ficha_caracterizacion
 * @property Instructor|null $instructor
 * @property ResultadoAprendizaje|null $resultado_aprendizaje
 *
 * @package App\Models
 */
class Evento extends Model
{
	protected $table = 'tbl_eventos';

	protected $casts = [
		'start' => 'datetime',
		'end' => 'datetime',
		'Codigo_resultado_aprendizaje' => 'int',
		'Codigo_instructor' => 'int',
		'Codigo_ficha' => 'int',
		'Codigo_ambiente' => 'int',
		'Codigo_competencia' => 'int'
	];

	protected $fillable = [
		'title',
		'descripcion',
		'color',
		'start',
		'end',
		'horaInicio',
		'horaFinal',
		'Codigo_resultado_aprendizaje',
		'Codigo_instructor',
		'Codigo_ficha',
		'Codigo_ambiente',
		'Codigo_competencia'
	];

	public function ambiente()
	{
		return $this->belongsTo(Ambiente::class, 'Codigo_ambiente');
	}

	public function competencia()
	{
		return $this->belongsTo(Competencia::class, 'Codigo_competencia');
	}

	public function ficha_caracterizacion()
	{
		return $this->belongsTo(FichaCaracterizacion::class, 'Codigo_ficha');
	}

	public function instructor()
	{
		return $this->belongsTo(Instructor::class, 'Codigo_instructor');
	}

	public function resultado_aprendizaje()
	{
		return $this->belongsTo(ResultadoAprendizaje::class, 'Codigo_resultado_aprendizaje');
	}
}
