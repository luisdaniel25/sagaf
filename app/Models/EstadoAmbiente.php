<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoAmbiente
 * 
 * @property int $Codigo
 * @property string $est_Denominacion
 * @property string $est_FichaTecnica
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Ambiente[] $ambientes
 *
 * @package App\Models
 */
class EstadoAmbiente extends Model
{
	protected $table = 'tbl_estado_ambientes';
	protected $primaryKey = 'Codigo';

	protected $fillable = [
		'est_Denominacion',
		'est_FichaTecnica'
	];

	public function ambientes()
	{
		return $this->hasMany(Ambiente::class, 'Codigo_estado');
	}
}
