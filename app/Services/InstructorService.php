<?php

namespace App\Services;

use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class InstructorService
{
    public function store(
        array $data,
        array $competencias = []
    ): Instructor {

        return DB::transaction(
            function () use (
                $data,
                $competencias
            ) {

                $data['inst_TipoID'] =
                    $data['inst_TipoID']
                    ?? 'CC';

                $instructor =
                    Instructor::create($data);

                if (!empty($competencias)) {

                    $instructor
                        ->competencias()
                        ->sync($competencias);
                }

                return $instructor;
            }
        );
    }

    public function update(
        Instructor $instructor,
        array $data,
        array $competencias = []
    ): bool {

        return DB::transaction(
            function () use (
                $instructor,
                $data,
                $competencias
            ) {

                $data['inst_TipoID'] =
                    $data['inst_TipoID']
                    ?? 'CC';

                $instructor->update(
                    $data
                );

                $instructor
                    ->competencias()
                    ->sync($competencias);

                return true;
            }
        );
    }

    public function delete(
        Instructor $instructor
    ): void {

        DB::transaction(
            function () use (
                $instructor
            ) {

                $instructor
                    ->competencias()
                    ->detach();

                $instructor
                    ->delete();
            }
        );
    }
}
