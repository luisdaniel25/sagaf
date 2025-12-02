<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Corrección: No es necesario usar with() para campos simples del mismo modelo
        $programasFormacion = Programa::paginate(10);

        // Retornar la vista con los datos
        return view('programas.index', compact('programasFormacion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prog_Denominacion' => 'required|string|max:255',
            'prog_version' => 'required|integer',
            'prog_Estado' => 'nullable|string',
            'prog_HorasEstimadas' => 'required|string',
            'prog_Creditos' => 'required|string',
            'prog_Descripcion' => 'required|string',
            'prog_DuracionMeses' => 'required|string',
            'prog_NivelFormacion' => 'nullable|string',
            'prog_etapaLectiva' => 'required|integer',
            'prog_etapaProductiva' => 'required|integer',
            'prog_totalHoras' => 'required|integer',
            'prog_justificacion' => 'required|string',
            'prog_metodologia' => 'required|string'
        ]);

        Programa::create($validated);

        return redirect()->route('programas.index')
            ->with('success', 'Programa creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programa = Programa::findOrFail($id);
        return view('programas.show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programa = Programa::findOrFail($id);
        return view('programas.edit', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $programa = Programa::findOrFail($id);

        $validated = $request->validate([
            'prog_Denominacion' => 'required|string|max:255',
            'prog_version' => 'required|integer',
            'prog_Estado' => 'nullable|string',
            'prog_HorasEstimadas' => 'required|string',
            'prog_Creditos' => 'required|string',
            'prog_Descripcion' => 'required|string',
            'prog_DuracionMeses' => 'required|string',
            'prog_NivelFormacion' => 'nullable|string',
            'prog_etapaLectiva' => 'required|integer',
            'prog_etapaProductiva' => 'required|integer',
            'prog_totalHoras' => 'required|integer',
            'prog_justificacion' => 'required|string',
            'prog_metodologia' => 'required|string'
        ]);

        $programa->update($validated);

        return redirect()->route('programas.index')
            ->with('success', 'Programa actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programa = Programa::findOrFail($id);
        $programa->delete();

        return redirect()->route('programas.index')
            ->with('success', 'Programa eliminado exitosamente.');
    }
}
