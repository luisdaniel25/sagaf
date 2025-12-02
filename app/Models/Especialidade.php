<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Especialidade
 * 
 * @property int $Codigo
 * @property string $esp_Denominacion
 * @property int $Codigo_red
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Rede $rede
 *
 * @package App\Models
 */
class Especialidade extends Model
{
	protected $table = 'tbl_especialidades';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_red' => 'int'
	];

	protected $fillable = [
		'esp_Denominacion',
		'Codigo_red'
	];

	public function rede()
	{
		return $this->belongsTo(Rede::class, 'Codigo_red');
	}
}
