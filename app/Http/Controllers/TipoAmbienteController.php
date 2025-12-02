<?php

namespace App\Http\Controllers;

use App\Models\TipoAmbiente;
use Illuminate\Http\Request;

class TipoAmbienteController extends Controller
{
    /**
     * Mostrar listado de tipos de ambientes
     */
    public function index()
    {
        $tipos = TipoAmbiente::orderBy('Codigo', 'DESC')->paginate(10);
        return view('tipo-ambientes.index', compact('tipos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('tipo-ambientes.create');
    }

    /**
     * Guardar un nuevo tipo de ambiente
     */
    public function store(Request $request)
    {
        $request->validate([
            'tip_Denominacion' => 'required|string|max:255|unique:tbl_tipo_ambientes,tip_Denominacion',
        ]);

        TipoAmbiente::create([
            'tip_Denominacion' => $request->tip_Denominacion
        ]);

        return redirect()->route('tipo-ambientes.index')
            ->with('success', 'El tipo de ambiente se creó correctamente.');
    }

    /**
     * Mostrar un tipo de ambiente específico
     */
    public function show($id)
    {
        $tipo = TipoAmbiente::findOrFail($id);
        return view('tipo-ambientes.show', compact('tipo'));
    }

    /**
     * Mostrar formulario para editar
     */
    public function edit($id)
    {
        $tipo = TipoAmbiente::findOrFail($id);
        return view('tipo-ambientes.edit', compact('tipo'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, $id)
    {
        $tipo = TipoAmbiente::findOrFail($id);

        $request->validate([
            'tip_Denominacion' => 'required|string|max:255|unique:tbl_tipo_ambientes,tip_Denominacion,' . $id . ',Codigo',
        ]);

        $tipo->update([
            'tip_Denominacion' => $request->tip_Denominacion
        ]);

        return redirect()->route('tipo-ambientes.index')
            ->with('success', 'El tipo de ambiente se actualizó correctamente.');
    }

    /**
     * Eliminar registro
     */
    public function destroy($id)
    {
        $tipo = TipoAmbiente::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipo-ambientes.index')
            ->with('success', 'El tipo de ambiente se eliminó correctamente.');
    }
}
