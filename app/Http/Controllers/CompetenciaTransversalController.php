<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use Illuminate\Http\Request;

class CompetenciaTransversalController extends Controller
{
    public function index()
    {
        return Competencia::all();
    }

    public function store(Request $request)
    {
        $competencia = Competencia::create($request->all());

        return response()->json([
            'message' => 'Competencia creada correctamente',
            'data' => $competencia
        ]);
    }

    public function show($id)
    {
        return Competencia::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $competencia = Competencia::findOrFail($id);
        $competencia->update($request->all());

        return response()->json([
            'message' => 'Competencia actualizada',
            'data' => $competencia
        ]);
    }

    public function destroy($id)
    {
        Competencia::destroy($id);

        return response()->json(['message' => 'Competencia eliminada']);
    }
}
