<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NivelFormacion
 * 
 * @property int $Codigo
 * @property string|null $niv_Denominacion
 *
 * @package App\Models
 */
class NivelFormacion extends Model
{
	protected $table = 'tbl_nivel_formacions';
	protected $primaryKey = 'Codigo';
	public $timestamps = false;

	protected $fillable = [
		'niv_Denominacion'
	];
}
