<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Modalidad
 * 
 * @property int $id
 * @property string $mod_Denominacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|FichaCaracterizacion[] $ficha_caracterizacions
 *
 * @package App\Models
 */
class Modalidad extends Model
{
	protected $table = 'tbl_modalidads';

	protected $fillable = [
		'mod_Denominacion'
	];

	public function ficha_caracterizacions()
	{
		return $this->hasMany(FichaCaracterizacion::class, 'Codigo_modalidad');
	}
}
