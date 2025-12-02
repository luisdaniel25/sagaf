<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CentroFormacion
 * 
 * @property int $Codigo
 * @property string $cent_Denominacion
 * @property int $Codigo_regional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Regionale $regionale
 * @property Collection|Aprendiz[] $aprendizs
 * @property Collection|FichaCaracterizacion[] $ficha_caracterizacions
 *
 * @package App\Models
 */
class CentroFormacion extends Model
{
	protected $table = 'tbl_centro_formacions';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_regional' => 'int'
	];

	protected $fillable = [
		'cent_Denominacion',
		'Codigo_regional'
	];

	public function regionale()
	{
		return $this->belongsTo(Regionale::class, 'Codigo_regional');
	}

	public function aprendizs()
	{
		return $this->hasMany(Aprendiz::class, 'Codigo_centro');
	}

	public function ficha_caracterizacions()
	{
		return $this->hasMany(FichaCaracterizacion::class, 'Codigo_centro');
	}
}
