<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Programa
 *
 * @property int $prog_codigoPrograma
 * @property string $prog_Denominacion
 * @property int $prog_version
 * @property string|null $prog_Estado
 * @property string $prog_HorasEstimadas
 * @property string $prog_Creditos
 * @property string $prog_Descripcion
 * @property string $prog_DuracionMeses
 * @property string|null $prog_NivelFormacion
 * @property int $prog_etapaLectiva
 * @property int $prog_etapaProductiva
 * @property int $prog_totalHoras
 * @property string $prog_justificacion
 * @property string $prog_metodologia
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Aprendiz[] $aprendizs
 * @property Collection|Competencia[] $competencias
 * @property Collection|FichaCaracterizacion[] $ficha_caracterizacions
 * @property Collection|PerfilInstructor[] $perfil_instructors
 *
 * @package App\Models
 */
class Programa extends Model
{
	protected $table = 'tbl_programas';
	protected $primaryKey = 'prog_codigoPrograma';

    protected $casts = [
        'prog_version' => 'integer',
        'prog_HorasEstimadas' => 'integer',
        'prog_Creditos' => 'integer',
        'prog_DuracionMeses' => 'integer',
        'prog_etapaLectiva' => 'integer',
        'prog_etapaProductiva' => 'integer',
        'prog_totalHoras' => 'integer',
    ];

	protected $fillable = [
		'prog_Denominacion',
		'prog_version',
		'prog_Estado',
		'prog_HorasEstimadas',
		'prog_Creditos',
		'prog_Descripcion',
		'prog_DuracionMeses',
		'prog_NivelFormacion',
		'prog_etapaLectiva',
		'prog_etapaProductiva',
		'prog_totalHoras',
		'prog_justificacion',
		'prog_metodologia'
	];

	public function aprendizs()
	{
		return $this->hasMany(Aprendiz::class, 'Codigo_programa');
	}

	public function competencias()
	{
		return $this->hasMany(Competencia::class, 'Codigo_programa');
	}

	public function ficha_caracterizacions()
	{
		return $this->hasMany(FichaCaracterizacion::class, 'Codigo_programa');
	}

	public function perfil_instructors()
	{
		return $this->hasMany(PerfilInstructor::class, 'Codigo_programa');
	}
    public function nivelFormacion()
    {
        return $this->belongsTo(
            NivelFormacion::class,
            'Codigo_nivel_formacion'
        );
    }
}
