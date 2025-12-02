<?php

namespace App\Console\Commands;

use App\Services\CompetenciaTransversalService;
use Illuminate\Console\Command;

class CorregirCompetenciasTransversales extends Command
{
    protected $signature = 'competencias:corregir-transversales';
    protected $description = 'Corrige automáticamente competencias que deberían ser transversales.';

    /**
     * Ejecutar el comando.
     */
    public function handle(CompetenciaTransversalService $service): int
    {
        $this->info('🔍 Analizando competencias...');

        // Obtener competencias posiblemente transversales y corregirlas
        $corregidas = $service->corregirCompetenciasTransversales();

        if ($corregidas->isEmpty()) {
            $this->info('✔ No se encontraron competencias para corregir.');
            return Command::SUCCESS;
        }

        $this->info("✔ Se corrigieron {$corregidas->count()} competencias:");
        foreach ($corregidas as $competencia) {
            $this->line("  - {$competencia->comp_Denominacion}");
        }

        return Command::SUCCESS;
    }
}
