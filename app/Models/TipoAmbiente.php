<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoAmbiente
 * 
 * @property int $Codigo
 * @property string $tip_Denominacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Ambiente[] $ambientes
 *
 * @package App\Models
 */
class TipoAmbiente extends Model
{
	protected $table = 'tbl_tipo_ambientes';
	protected $primaryKey = 'Codigo';

	protected $fillable = [
		'tip_Denominacion'
	];

	public function ambientes()
	{
		return $this->hasMany(Ambiente::class, 'Codigo_tipo');
	}
}
