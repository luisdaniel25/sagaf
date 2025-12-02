<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequest;
use App\Models\Instructor;
use App\Models\Vigencia;
use App\Models\Competencia;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class InstructorController
 *
 * Controlador encargado de la gestión completa de instructores:
 * - Listado
 * - Crear / Editar
 * - Ver detalle
 * - Eliminar
 * - Gestión de competencias asociadas
 *
 * @package App\Http\Controllers
 */
class InstructorController extends Controller
{
    /**
     * Mostrar el listado de todos los instructores.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $instructores = Instructor::with(['vigencia', 'user'])->get();
        return view('instructores.index', compact('instructores'));
    }

    /**
     * Mostrar el formulario para crear un nuevo instructor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $vigencias = Vigencia::all();
        $competencias = Competencia::all();
        $usuarios = User::doesntHave('instructor')->get();

        return view('instructores.create', compact('vigencias', 'competencias', 'usuarios'));
    }

    /**
     * Guardar un nuevo instructor en la base de datos.
     *
     * @param  \App\Http\Requests\InstructorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InstructorRequest $request)
    {
        $data = $request->only([
            'inst_Nombres', 'inst_Apellido', 'inst_Identificacion', 'inst_TipoID',
            'inst_Correo', 'inst_Telefono', 'inst_Direccion', 'Codigo_vigencia', 'Codigo_usuario'
        ]);
        $data['inst_TipoID'] = $data['inst_TipoID'] ?? 'CC';

        $instructor = Instructor::create($data);

        // Sincronizar competencias si se proporcionan
        if ($request->filled('competencias')) {
            $instructor->competencias()->sync($request->competencias);
        }

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor creado correctamente');
    }

    /**
     * Mostrar los detalles de un instructor específico.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\View\View
     */
    public function show(Instructor $instructor)
    {
        $instructor->load(['vigencia', 'user', 'competencias']);
        return view('instructores.show', compact('instructor'));
    }

    /**
     * Mostrar el formulario de edición para un instructor existente.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\View\View
     */
    public function edit(Instructor $instructor)
    {
        $vigencias = Vigencia::all();
        $competencias = Competencia::all();
        $usuarios = User::doesntHave('instructor')->orWhere('id', $instructor->Codigo_usuario)->get();

        return view('instructores.edit', compact('instructor', 'vigencias', 'competencias', 'usuarios'));
    }

    /**
     * Actualizar los datos de un instructor existente en la base de datos.
     *
     * @param  \App\Http\Requests\InstructorRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InstructorRequest $request, Instructor $instructor)
    {
        $data = $request->only([
            'inst_Nombres', 'inst_Apellido', 'inst_Identificacion', 'inst_TipoID',
            'inst_Correo', 'inst_Telefono', 'inst_Direccion', 'Codigo_vigencia', 'Codigo_usuario'
        ]);
        $data['inst_TipoID'] = $data['inst_TipoID'] ?? 'CC';

        $instructor->update($data);

        if ($request->filled('competencias')) {
            $instructor->competencias()->sync($request->competencias);
        }

        return redirect()->route('instructores.index')
            ->with('success', 'Instructor actualizado correctamente');
    }

    /**
     * Eliminar un instructor de la base de datos.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();
        return redirect()->route('instructores.index')
            ->with('success', 'Instructor eliminado');
    }

    /**
     * Mostrar las competencias asociadas a un instructor específico.
     *
     * @param  int  $instructorId
     * @return \Illuminate\View\View
     */
    public function competencias($instructorId)
    {
        $instructor = Instructor::with('competencias')->findOrFail($instructorId);
        $competencias = Competencia::all();

        return view('instructores.competencias', compact('instructor', 'competencias'));
    }
}
