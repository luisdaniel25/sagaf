<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilInstructor
 * 
 * @property int $Codigo
 * @property string $per_RequisitosAcademicos
 * @property string $per_Experiencia
 * @property string $per_CompetenciasMinimas
 * @property int $Codigo_programa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Programa $programa
 *
 * @package App\Models
 */
class PerfilInstructor extends Model
{
	protected $table = 'tbl_perfil_instructors';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_programa' => 'int'
	];

	protected $fillable = [
		'per_RequisitosAcademicos',
		'per_Experiencia',
		'per_CompetenciasMinimas',
		'Codigo_programa'
	];

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'Codigo_programa');
	}
}
