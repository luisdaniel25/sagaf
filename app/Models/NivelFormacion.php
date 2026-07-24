<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelFormacion extends Model
{
    protected $table = 'tbl_nivel_formacions';

    protected $primaryKey = 'Codigo';

    public $timestamps = false;

    protected $fillable = [
        'niv_Denominacion',
    ];

    public function scopePorNombre($query, string $nombre)
    {
        return $query->where(
            'niv_Denominacion',
            $nombre
        );
    }
}
