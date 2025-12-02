<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\TipoAmbiente;
use App\Models\EstadoAmbiente;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    public function index(Request $request)
    {
        $tipos = TipoAmbiente::all();
        $estados = EstadoAmbiente::all();

        $query = Ambiente::query()->with(['tipo_ambiente', 'estado_ambiente']);

        if ($request->filled('search')) {
            $query->where('amb_Denominacion', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('estado')) {
            $query->where('Codigo_estado', $request->estado);
        }

        if ($request->filled('tipo')) {
            $query->where('Codigo_tipo', $request->tipo);
        }

        $ambientes = $query->orderBy('Codigo', 'desc')->paginate(10);

        return view('ambientes.index', compact('ambientes', 'tipos', 'estados'));
    }

    public function create()
    {
        $tipos = TipoAmbiente::all();
        $estados = EstadoAmbiente::all();

        return view('ambientes.create', compact('tipos', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amb_Denominacion' => 'required|string|max:255',
            'amb_Cupo' => 'required|integer|min:1',
            'Codigo_tipo' => 'required|integer|exists:tbl_tipo_ambientes,Codigo',
            'Codigo_estado' => 'required|integer|exists:tbl_estado_ambientes,Codigo',
        ]);

        Ambiente::create($request->all());

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente creado correctamente.');
    }

    public function show($Codigo)
    {
        $ambiente = Ambiente::with([
            'tipo_ambiente',
            'estado_ambiente',
            'asignaciones_instructores.instructor',
            'asignaciones_instructores.ficha_caracterizacion'
        ])->findOrFail($Codigo);

        return view('ambientes.show', compact('ambiente'));
    }

    public function edit($Codigo)
    {
        $ambiente = Ambiente::findOrFail($Codigo);
        $tipos = TipoAmbiente::all();
        $estados = EstadoAmbiente::all();

        return view('ambientes.edit', compact('ambiente', 'tipos', 'estados'));
    }

    public function update(Request $request, $Codigo)
    {
        $request->validate([
            'amb_Denominacion' => 'required|string|max:255',
            'amb_Cupo' => 'required|integer|min:1',
            'Codigo_tipo' => 'required|integer|exists:tbl_tipo_ambientes,Codigo',
            'Codigo_estado' => 'required|integer|exists:tbl_estado_ambientes,Codigo',
        ]);

        $ambiente = Ambiente::findOrFail($Codigo);

        // Si el ambiente pasa a mantenimiento, liberar asignaciones
        if ($request->Codigo_estado == 3 && $ambiente->Codigo_estado != 3) {
            $ambiente->asignaciones_instructores()->delete();
        }

        $ambiente->update($request->all());

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente actualizado correctamente.');
    }

    public function destroy($Codigo)
    {
        $ambiente = Ambiente::findOrFail($Codigo);

        if ($ambiente->asignaciones_instructores()->exists()) {
            return redirect()->route('ambientes.index')
                ->with('error', 'No se puede eliminar el ambiente porque tiene asignaciones activas.');
        }

        $ambiente->delete();

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente eliminado correctamente.');
    }

    // Métodos adicionales
    public function ponerEnMantenimiento($Codigo)
    {
        $ambiente = Ambiente::findOrFail($Codigo);

        $ambiente->asignaciones_instructores()->delete();
        $ambiente->update(['Codigo_estado' => 3]);

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente puesto en mantenimiento correctamente.');
    }

    public function liberar($Codigo)
    {
        $ambiente = Ambiente::findOrFail($Codigo);
        $ambiente->update(['Codigo_estado' => 1]);

        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente liberado correctamente.');
    }
}
