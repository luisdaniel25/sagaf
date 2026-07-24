<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetenciaStoreRequest;
use App\Http\Requests\CompetenciaUpdateRequest;
use App\Models\Competencia;
use App\Services\CompetenciaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetenciaTransversalController extends Controller
{
    public function __construct(
        private readonly CompetenciaService $service
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $competencias = Competencia::query()
            ->with([
                'programa',
                'resultado_aprendizajes'
            ])
            ->paginate(
                $request->integer('per_page', 15)
            );

        return response()->json($competencias);
    }

    public function store(
        CompetenciaStoreRequest $request
    ): JsonResponse {

        $competencia = $this->service->store(
            $request->validated()
        );

        return response()->json([
            'message' => 'Competencia creada correctamente.',
            'data' => $competencia,
        ], 201);
    }

    public function show(
        Competencia $competencia
    ): JsonResponse {

        $competencia->load([
            'programa',
            'resultado_aprendizajes'
        ]);

        return response()->json([
            'data' => $competencia
        ]);
    }

    public function update(
        CompetenciaUpdateRequest $request,
        Competencia $competencia
    ): JsonResponse {

        $this->service->update(
            $competencia,
            $request->validated()
        );

        return response()->json([
            'message' => 'Competencia actualizada correctamente.',
            'data' => $competencia->fresh()
        ]);
    }

    public function destroy(
        Competencia $competencia
    ): JsonResponse {

        $this->service->delete(
            $competencia
        );

        return response()->json([
            'message' => 'Competencia eliminada correctamente.'
        ]);
    }
}
