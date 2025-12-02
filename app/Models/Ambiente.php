<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ambiente
 * 
 * @property int $Codigo
 * @property string $amb_Denominacion
 * @property int $amb_Cupo
 * @property int $Codigo_tipo
 * @property int $Codigo_estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EstadoAmbiente $estado_ambiente
 * @property TipoAmbiente $tipo_ambiente
 * @property Collection|AsignacionesInstructore[] $asignaciones_instructores
 * @property Collection|Evento[] $eventos
 *
 * @package App\Models
 */
class Ambiente extends Model
{
	protected $table = 'tbl_ambientes';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'amb_Cupo' => 'int',
		'Codigo_tipo' => 'int',
		'Codigo_estado' => 'int'
	];

	protected $fillable = [
		'amb_Denominacion',
		'amb_Cupo',
		'Codigo_tipo',
		'Codigo_estado'
	];

	public function estado_ambiente()
	{
		return $this->belongsTo(EstadoAmbiente::class, 'Codigo_estado');
	}

	public function tipo_ambiente()
	{
		return $this->belongsTo(TipoAmbiente::class, 'Codigo_tipo');
	}

	public function asignaciones_instructores()
	{
		return $this->hasMany(AsignacionesInstructore::class, 'Codigo_ambiente');
	}

	public function eventos()
	{
		return $this->hasMany(Evento::class, 'Codigo_ambiente');
	}
}
