<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DisponibilidadInstructore
 * 
 * @property int $Codigo
 * @property int $Codigo_instructor
 * @property string $dia_semana
 * @property Carbon $hora_inicio
 * @property Carbon $hora_fin
 * @property string|null $dis_Estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Instructor $instructor
 *
 * @package App\Models
 */
class DisponibilidadInstructore extends Model
{
	protected $table = 'tbl_disponibilidad_instructores';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_instructor' => 'int',
		'hora_inicio' => 'datetime',
		'hora_fin' => 'datetime'
	];

	protected $fillable = [
		'Codigo_instructor',
		'dia_semana',
		'hora_inicio',
		'hora_fin',
		'dis_Estado'
	];

	public function instructor()
	{
		return $this->belongsTo(Instructor::class, 'Codigo_instructor');
	}
}
