<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Solicitud
 * 
 * @property int $Codigo
 * @property Carbon $sol_FechaSolicitud
 * @property string $sol_Estado
 * @property string|null $sol_Justificacion
 * @property string|null $sol_Observaciones
 * @property int $Codigo_instructor
 * @property int $Codigo_competencia
 * @property int $Codigo_ficha
 * @property Carbon $sol_FechaPropuesta
 * @property int $sol_HorasSolicitadas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $sol_Prioridad
 * 
 * @property Competencia $competencia
 * @property FichaCaracterizacion $ficha_caracterizacion
 * @property Instructor $instructor
 * @property Collection|Notificacione[] $notificaciones
 *
 * @package App\Models
 */
class Solicitud extends Model
{
	protected $table = 'tbl_solicitud';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'sol_FechaSolicitud' => 'datetime',
		'Codigo_instructor' => 'int',
		'Codigo_competencia' => 'int',
		'Codigo_ficha' => 'int',
		'sol_FechaPropuesta' => 'datetime',
		'sol_HorasSolicitadas' => 'int'
	];

	protected $fillable = [
		'sol_FechaSolicitud',
		'sol_Estado',
		'sol_Justificacion',
		'sol_Observaciones',
		'Codigo_instructor',
		'Codigo_competencia',
		'Codigo_ficha',
		'sol_FechaPropuesta',
		'sol_HorasSolicitadas',
		'sol_Prioridad'
	];

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

	public function notificaciones()
	{
		return $this->hasMany(Notificacione::class, 'Codigo_solicitud');
	}
}
