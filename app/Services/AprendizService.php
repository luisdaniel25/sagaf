<?php

namespace App\Services;

use App\Models\Aprendiz;
use Illuminate\Support\Facades\DB;

class AprendizService
{
    public function store(
        array $data
    ): Aprendiz {

        return DB::transaction(
            fn () => Aprendiz::create($data)
        );
    }

    public function update(
        Aprendiz $aprendiz,
        array $data
    ): bool {

        return DB::transaction(
            fn () => $aprendiz->update($data)
        );
    }

    public function delete(
        Aprendiz $aprendiz
    ): void {

        DB::transaction(function () use (
            $aprendiz
        ) {

            $aprendiz->delete();
        });
    }
}
