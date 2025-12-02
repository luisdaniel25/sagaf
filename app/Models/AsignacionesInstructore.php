<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AsignacionesInstructore
 *
 * @property int $Codigo
 * @property int $Codigo_instructor
 * @property int $Codigo_ficha
 * @property int $Codigo_competencia
 * @property int|null $Codigo_ambiente
 * @property Carbon $FechaAsignacion
 * @property string|null $Estado
 * @property string|null $Observaciones
 *
 * @property Instructor $instructor
 * @property FichaCaracterizacion $ficha_caracterizacion
 * @property Competencia $competencia
 * @property Ambiente|null $ambiente
 * @property Collection|Notificacione[] $notificaciones
 *
 * @package App\Models
 */
class AsignacionesInstructore extends Model
{
    protected $table = 'tbl_asignaciones_instructores';
    protected $primaryKey = 'Codigo';
    public $timestamps = false;

    protected $casts = [
        'Codigo_instructor' => 'int',
        'Codigo_ficha' => 'int',
        'Codigo_competencia' => 'int',
        'Codigo_ambiente' => 'int',
        'FechaAsignacion' => 'datetime'
    ];

    protected $fillable = [
        'Codigo_instructor',
        'Codigo_ficha',
        'Codigo_competencia',
        'Codigo_ambiente',
        'FechaAsignacion',
        'Estado',
        'Observaciones'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'Codigo_instructor');
    }

    public function ficha_caracterizacion()
    {
        return $this->belongsTo(FichaCaracterizacion::class, 'Codigo_ficha');
    }

    public function competencia()
    {
        return $this->belongsTo(Competencia::class, 'Codigo_competencia', 'comp_codigoCompetencia');
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'Codigo_ambiente');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificacione::class, 'Codigo_asignacion');
    }
}
