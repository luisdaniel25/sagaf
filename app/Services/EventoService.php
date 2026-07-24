<?php

namespace App\Services;

use App\Models\Evento;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class EventoService
{
    public function store(
        array $data
    ): Evento {

        return DB::transaction(function () use ($data) {

            $this->validarConflictoHorario($data);

            return Evento::create($data);
        });
    }

    public function update(
        Evento $evento,
        array $data
    ): bool {

        return DB::transaction(function () use (
            $evento,
            $data
        ) {

            $this->validarConflictoHorario(
                $data,
                $evento->Codigo
            );

            return $evento->update($data);
        });
    }

    public function delete(
        Evento $evento
    ): void {

        DB::transaction(
            fn () => $evento->delete()
        );
    }

    private function validarConflictoHorario(
        array $data,
        ?int $eventoId = null
    ): void {

        if (empty($data['Codigo_ambiente'])) {
            return;
        }

        $query = Evento::query()
            ->where(
                'Codigo_ambiente',
                $data['Codigo_ambiente']
            )
            ->where(function ($q) use ($data) {

                $q->whereBetween(
                    'start',
                    [
                        $data['start'],
                        $data['end']
                    ]
                )
                    ->orWhereBetween(
                        'end',
                        [
                            $data['start'],
                            $data['end']
                        ]
                    );
            });

        if ($eventoId) {
            $query->where(
                'Codigo',
                '!=',
                $eventoId
            );
        }

        if ($query->exists()) {
            throw new RuntimeException(
                'Existe un conflicto de horario en el ambiente seleccionado.'
            );
        }
    }
}
