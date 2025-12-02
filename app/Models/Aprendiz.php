<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Aprendiz
 * 
 * @property int $Codigo
 * @property string $apr_PrimerNombre
 * @property string|null $apr_SegundoNombre
 * @property string $apr_Apellidos
 * @property string $apr_TipoDocumento
 * @property string $apr_NumeroDocumento
 * @property Carbon $apr_FechaNacimiento
 * @property string|null $apr_Direccion
 * @property string|null $apr_Telefono
 * @property string|null $apr_TelefonoWhatsapp
 * @property string|null $apr_CorreoPersonal
 * @property string|null $apr_CorreoSena
 * @property string $apr_SedeFormacion
 * @property string $apr_Jornada
 * @property string $apr_ModalidadFormacion
 * @property Carbon $apr_FechaInicioFormacion
 * @property Carbon|null $apr_FechaFinalizacionFormacion
 * @property int $Codigo_programa
 * @property int $Codigo_ficha
 * @property int $Codigo_centro
 * @property int|null $Codigo_regional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CentroFormacion $centro_formacion
 * @property FichaCaracterizacion $ficha_caracterizacion
 * @property Programa $programa
 * @property Regionale|null $regionale
 *
 * @package App\Models
 */
class Aprendiz extends Model
{
	protected $table = 'tbl_aprendiz';
	protected $primaryKey = 'Codigo';

	protected $casts = [
		'apr_FechaNacimiento' => 'datetime',
		'apr_FechaInicioFormacion' => 'datetime',
		'apr_FechaFinalizacionFormacion' => 'datetime',
		'Codigo_programa' => 'int',
		'Codigo_ficha' => 'int',
		'Codigo_centro' => 'int',
		'Codigo_regional' => 'int'
	];

	protected $fillable = [
		'apr_PrimerNombre',
		'apr_SegundoNombre',
		'apr_Apellidos',
		'apr_TipoDocumento',
		'apr_NumeroDocumento',
		'apr_FechaNacimiento',
		'apr_Direccion',
		'apr_Telefono',
		'apr_TelefonoWhatsapp',
		'apr_CorreoPersonal',
		'apr_CorreoSena',
		'apr_SedeFormacion',
		'apr_Jornada',
		'apr_ModalidadFormacion',
		'apr_FechaInicioFormacion',
		'apr_FechaFinalizacionFormacion',
		'Codigo_programa',
		'Codigo_ficha',
		'Codigo_centro',
		'Codigo_regional'
	];

	public function centro_formacion()
	{
		return $this->belongsTo(CentroFormacion::class, 'Codigo_centro');
	}

	public function ficha_caracterizacion()
	{
		return $this->belongsTo(FichaCaracterizacion::class, 'Codigo_ficha');
	}

	public function programa()
	{
		return $this->belongsTo(Programa::class, 'Codigo_programa');
	}

	public function regionale()
	{
		return $this->belongsTo(Regionale::class, 'Codigo_regional');
	}
}
