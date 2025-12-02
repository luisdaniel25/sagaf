<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoCompetencia
 * 
 * @property int $Codigo
 * @property string|null $tipo_Denominacion
 * 
 * @property Collection|Competencia[] $competencias
 *
 * @package App\Models
 */
class TipoCompetencia extends Model
{
	protected $table = 'tbl_tipo_competencias';
	protected $primaryKey = 'Codigo';
	public $timestamps = false;

	protected $fillable = [
		'tipo_Denominacion'
	];

	public function competencias()
	{
		return $this->hasMany(Competencia::class, 'Codigo_tipo');
	}
}
