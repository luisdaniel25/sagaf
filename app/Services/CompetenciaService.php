<?php

namespace App\Services;

use App\Models\Competencia;
use Illuminate\Support\Facades\DB;

class CompetenciaService
{
    public function store(
        array $data
    ): Competencia {

        return DB::transaction(
            fn() => Competencia::create($data)
        );
    }

    public function update(
        Competencia $competencia,
        array $data
    ): bool {

        return DB::transaction(
            fn() => $competencia->update($data)
        );
    }

    public function delete(
        Competencia $competencia
    ): void {

        DB::transaction(
            fn() => $competencia->delete()
        );
    }
}
