<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Aprendiz extends Model
{
    protected $table = 'tbl_aprendiz';

    protected $primaryKey = 'Codigo';

    protected $keyType = 'int';

    public $incrementing = true;

    protected $casts = [
        'apr_FechaNacimiento' => 'datetime',
        'apr_FechaInicioFormacion' => 'datetime',
        'apr_FechaFinalizacionFormacion' => 'datetime',
        'Codigo_programa' => 'integer',
        'Codigo_ficha' => 'integer',
        'Codigo_centro' => 'integer',
        'Codigo_regional' => 'integer',
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

    protected $appends = [
        'nombre_completo'
    ];

    public function getNombreCompletoAttribute(): string
    {
        return trim(
            "{$this->apr_PrimerNombre} {$this->apr_SegundoNombre} {$this->apr_Apellidos}"
        );
    }
}
