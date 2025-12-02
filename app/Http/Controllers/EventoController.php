<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Mostrar todos los eventos registrados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Cargar relaciones necesarias para mostrar información completa
        $eventos = Evento::with([
            'ambiente',
            'competencia',
            'ficha',
            'instructor',
            'resultadoAprendizaje'
        ])->get();

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo evento.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Almacenar un nuevo evento en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'color'        => 'nullable|string|max:20',
            'start'        => 'required|date',
            'end'          => 'required|date|after_or_equal:start',
            'horaInicio'   => 'required|string',
            'horaFinal'    => 'required|string',
            'Codigo_resultado_aprendizaje' => 'nullable|integer',
            'Codigo_instructor'            => 'nullable|integer',
            'Codigo_ficha'                 => 'nullable|integer',
            'Codigo_ambiente'              => 'nullable|integer',
            'Codigo_competencia'           => 'nullable|integer',
        ]);

        // Crear el evento
        Evento::create($data);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado correctamente');
    }

    /**
     * Mostrar un evento específico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $evento = Evento::with([
            'ambiente',
            'competencia',
            'ficha',
            'instructor',
            'resultadoAprendizaje'
        ])->findOrFail($id);

        return view('eventos.show', compact('evento'));
    }

    /**
     * Mostrar el formulario para editar un evento.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);

        return view('eventos.edit', compact('evento'));
    }

    /**
     * Actualizar un evento existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        // Validar los datos ingresados
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'color'        => 'nullable|string|max:20',
            'start'        => 'required|date',
            'end'          => 'required|date|after_or_equal:start',
            'horaInicio'   => 'required|string',
            'horaFinal'    => 'required|string',
            'Codigo_resultado_aprendizaje' => 'nullable|integer',
            'Codigo_instructor'            => 'nullable|integer',
            'Codigo_ficha'                 => 'nullable|integer',
            'Codigo_ambiente'              => 'nullable|integer',
            'Codigo_competencia'           => 'nullable|integer',
        ]);

        // Actualizar el evento
        $evento->update($data);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento actualizado correctamente');
    }

    /**
     * Eliminar un evento de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado correctamente');
    }
}
