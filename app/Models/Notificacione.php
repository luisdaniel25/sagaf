<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacione
 * 
 * @property int $Codigo
 * @property string $not_Titulo
 * @property string $not_Mensaje
 * @property string $not_Estado
 * @property string $not_Tipo
 * @property int $Codigo_usuario
 * @property int|null $Codigo_solicitud
 * @property int|null $Codigo_asignacion
 * @property int|null $Codigo_referencia
 * @property string|null $tipo_referencia
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AsignacionesInstructore|null $asignaciones_instructore
 * @property Solicitud|null $solicitud
 *
 * @package App\Models
 */
class Notificacione extends Model
{
	protected $table = 'tbl_notificaciones';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'Codigo_usuario' => 'int',
		'Codigo_solicitud' => 'int',
		'Codigo_asignacion' => 'int',
		'Codigo_referencia' => 'int'
	];

	protected $fillable = [
		'not_Titulo',
		'not_Mensaje',
		'not_Estado',
		'not_Tipo',
		'Codigo_usuario',
		'Codigo_solicitud',
		'Codigo_asignacion',
		'Codigo_referencia',
		'tipo_referencia'
	];

	public function asignaciones_instructore()
	{
		return $this->belongsTo(AsignacionesInstructore::class, 'Codigo_asignacion');
	}

	public function solicitud()
	{
		return $this->belongsTo(Solicitud::class, 'Codigo_solicitud');
	}
}
