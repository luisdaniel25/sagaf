<?php

namespace App\Http\Controllers;

use App\Models\FichaCaracterizacion;
use App\Models\CentroFormacion;
use App\Models\Modalidad;
use App\Models\Programa;
use Illuminate\Http\Request;

class FichaCaracterizacionController extends Controller
{
    public function index(Request $request)
    {
        $query = FichaCaracterizacion::query()->with([
            'centro_formacion',
            'modalidad',
            'programa'
        ]);

        if ($request->filled('search')) {
            $query->where('Codigo', 'like', '%' . $request->search . '%');
        }

        $fichas = $query->orderBy('Codigo', 'desc')->paginate(10);

        return view('fichas.index', compact('fichas'));
    }

    public function create()
    {
        $modalidades = Modalidad::all();
        $centros = CentroFormacion::all();
        $programas = Programa::all();

        // Debug para verificar datos
        // dd($modalidades, $centros, $programas);

        return view('fichas.create', compact('modalidades', 'centros', 'programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Codigo' => 'required|integer|unique:tbl_ficha_caracterizacions,Codigo',
            'fich_Inicio' => 'required|date',
            'fich_Fin' => 'required|date|after:fich_Inicio',
            'fich_Etapa' => 'required|string|in:Lectiva,Productiva',
            'Codigo_modalidad' => 'required|integer|exists:tbl_modalidads,id',
            'Codigo_programa' => 'required|integer|exists:tbl_programas,prog_codigoPrograma',
            'Codigo_centro' => 'required|integer|exists:tbl_centro_formacions,Codigo',
        ]);

        FichaCaracterizacion::create($request->all());

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha creada correctamente.');
    }

    public function show($id)
    {
        $ficha = FichaCaracterizacion::with([
            'centro_formacion',
            'modalidad',
            'programa',
            'aprendizs'
        ])->findOrFail($id);

        return view('fichas.show', compact('ficha'));
    }

    public function edit($id)
    {
        $ficha = FichaCaracterizacion::findOrFail($id);

        $modalidades = Modalidad::all();
        $centros = CentroFormacion::all();
        $programas = Programa::all();

        return view('fichas.edit', compact('ficha', 'modalidades', 'centros', 'programas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fich_Inicio' => 'required|date',
            'fich_Fin' => 'required|date|after:fich_Inicio',
            'fich_Etapa' => 'required|string|in:Lectiva,Productiva',
            'Codigo_modalidad' => 'required|integer|exists:tbl_modalidads,id',
            'Codigo_programa' => 'required|integer|exists:tbl_programas,prog_codigoPrograma',
            'Codigo_centro' => 'required|integer|exists:tbl_centro_formacions,Codigo',
        ]);

        $ficha = FichaCaracterizacion::findOrFail($id);
        $ficha->update($request->all());

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha actualizada correctamente.');
    }

    public function destroy($id)
    {
        $ficha = FichaCaracterizacion::findOrFail($id);

        // Verificar si hay relaciones antes de eliminar
        if ($ficha->aprendizs()->count() > 0) {
            return redirect()->route('fichas.index')
                ->with('error', 'No se puede eliminar la ficha porque tiene aprendices asociados.');
        }

        $ficha->delete();

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha eliminada correctamente.');
    }

    /**
     * AJAX: programas por centro
     */
    public function programasPorCentro($centroId)
    {
        $programas = Programa::where('Codigo_centro', $centroId)->get();
        return response()->json($programas);
    }
}
