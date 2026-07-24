<?php

/**
 * Created by Reliese Model.
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notificacione extends Model
{
    protected $table = 'tbl_notificaciones';

    protected $primaryKey = 'Codigo';

    protected $casts = [
        'Codigo_usuario' => 'integer',
        'Codigo_solicitud' => 'integer',
        'Codigo_asignacion' => 'integer',
        'Codigo_referencia' => 'integer',
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
        'tipo_referencia',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'Codigo_usuario'
        );
    }

    public function scopePendientes($query)
    {
        return $query->where(
            'not_Estado',
            'PENDIENTE'
        );
    }
}
