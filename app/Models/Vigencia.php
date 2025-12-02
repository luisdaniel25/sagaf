<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vigencia
 * 
 * @property int $Codigo
 * @property int $vig_Contrato
 * @property string $vig_anio
 * @property Carbon $vig_Inicio
 * @property Carbon $vig_Fin
 * @property string $vig_Objetos
 * @property int $Codigo_red
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Rede $rede
 *
 * @package App\Models
 */
class Vigencia extends Model
{
	protected $table = 'tbl_vigencias';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'vig_Contrato' => 'int',
		'vig_Inicio' => 'datetime',
		'vig_Fin' => 'datetime',
		'Codigo_red' => 'int'
	];

	protected $fillable = [
		'vig_Contrato',
		'vig_anio',
		'vig_Inicio',
		'vig_Fin',
		'vig_Objetos',
		'Codigo_red'
	];

	public function rede()
	{
		return $this->belongsTo(Rede::class, 'Codigo_red');
	}
}
