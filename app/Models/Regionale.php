<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Regionale
 * 
 * @property int $Codigo
 * @property string $reg_Denominacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Aprendiz[] $aprendizs
 * @property Collection|CentroFormacion[] $centro_formacions
 *
 * @package App\Models
 */
class Regionale extends Model
{
	protected $table = 'tbl_regionales';
	protected $primaryKey = 'Codigo';

	protected $fillable = [
		'reg_Denominacion'
	];

	public function aprendizs()
	{
		return $this->hasMany(Aprendiz::class, 'Codigo_regional');
	}

	public function centro_formacions()
	{
		return $this->hasMany(CentroFormacion::class, 'Codigo_regional');
	}
}
