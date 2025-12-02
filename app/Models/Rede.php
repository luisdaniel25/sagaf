<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rede
 * 
 * @property int $Codigo
 * @property string $red_Denominacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Especialidade[] $especialidades
 * @property Collection|Vigencia[] $vigencias
 *
 * @package App\Models
 */
class Rede extends Model
{
	protected $table = 'tbl_redes';
	protected $primaryKey = 'Codigo';

	protected $fillable = [
		'red_Denominacion'
	];

	public function especialidades()
	{
		return $this->hasMany(Especialidade::class, 'Codigo_red');
	}

	public function vigencias()
	{
		return $this->hasMany(Vigencia::class, 'Codigo_red');
	}
}
