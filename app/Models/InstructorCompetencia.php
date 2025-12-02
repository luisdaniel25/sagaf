<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstructorCompetencia
 * 
 * @property int $Codigo
 * @property int $Codigo_instructor
 * @property int $Codigo_competencia
 * @property string|null $hab_Estado
 * @property Carbon|null $hab_FechaHabilitacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Competencia $competencia
 * @property Instructor $instructor
 *
 * @package App\Models
 */
class InstructorCompetencia extends Model
{
	protected $table = 'tbl_instructor_competencias';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_instructor' => 'int',
		'Codigo_competencia' => 'int',
		'hab_FechaHabilitacion' => 'datetime'
	];

	protected $fillable = [
		'Codigo_instructor',
		'Codigo_competencia',
		'hab_Estado',
		'hab_FechaHabilitacion'
	];

	public function competencia()
	{
		return $this->belongsTo(Competencia::class, 'Codigo_competencia');
	}

	public function instructor()
	{
		return $this->belongsTo(Instructor::class, 'Codigo_instructor');
	}
}
