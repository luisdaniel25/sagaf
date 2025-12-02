<?php

namespace App\Services;

use App\Models\Competencia;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CompetenciaTransversalService
{
    private array $palabrasClave = [
        'gestión', 'gestion', 'comunicación', 'comunicacion',
        'liderazgo', 'trabajo en equipo', 'proyecto',
        'emprendimiento', 'ética', 'etica', 'digital',
        'innovación', 'innovacion', 'creatividad',
        'resolución', 'resolucion', 'adaptabilidad',
        'colaboración', 'colaboracion'
    ];

    public function esCompetenciaTransversal(string $denominacion): bool
    {
        $d = strtolower($denominacion);
        return collect($this->palabrasClave)
            ->contains(fn($palabra) => Str::contains($d, strtolower($palabra)));
    }

    public function getCompetenciasTransversales(): Collection
    {
        return Competencia::where('comp_Tipo', 'Transversal')
            ->with('programa')
            ->get();
    }

    public function getCompetenciasPosiblementeTransversales(): Collection
    {
        return Competencia::where('comp_Tipo', 'Especifica')
            ->where(function($query) {
                foreach ($this->palabrasClave as $palabra) {
                    $query->orWhere('comp_Denominacion', 'LIKE', "%{$palabra}%");
                }
            })
            ->get();
    }

    public function corregirCompetenciasTransversales(): Collection
    {
        $corregidas = collect();
        foreach ($this->getCompetenciasPosiblementeTransversales() as $competencia) {
            if ($this->esCompetenciaTransversal($competencia->comp_Denominacion)) {
                $competencia->update(['comp_Tipo' => 'Transversal']);
                $corregidas->push($competencia);
            }
        }
        return $corregidas;
    }

    public function crearCompetenciaTransversal(array $data): Competencia
    {
        $data['comp_Tipo'] = $this->esCompetenciaTransversal($data['comp_Denominacion'])
            ? 'Transversal'
            : 'Especifica';
        return Competencia::create($data);
    }
}
