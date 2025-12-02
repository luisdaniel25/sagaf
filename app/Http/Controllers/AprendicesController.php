<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use App\Models\Programa;
use App\Models\FichaCaracterizacion;
use App\Models\CentroFormacion;
use App\Models\Regionale;
use Illuminate\Http\Request;

class AprendicesController extends Controller
{
    /**
     * Mostrar listado de aprendices
     */
    public function index()
    {
        $aprendices = Aprendiz::with([
            'centro_formacion',
            'ficha_caracterizacion',
            'programa',
            'regionale'
        ])->paginate(10);

        return view('aprendices.index', compact('aprendices'));
    }

    /**
     * Mostrar detalle de un aprendiz
     */
    public function show($id)
    {
        $aprendiz = Aprendiz::with([
            'centro_formacion',
            'ficha_caracterizacion',
            'programa',
            'regionale'
        ])->findOrFail($id);

        return view('aprendices.show', compact('aprendiz'));
    }

    /**
     * Formulario para crear un aprendiz
     */
    public function create()
    {
        $programas = Programa::all();
        $fichas = FichaCaracterizacion::all();
        $centros = CentroFormacion::all();
        $regionales = Regionale::all();

        return view('aprendices.create', compact('programas', 'fichas', 'centros', 'regionales'));
    }

    /**
     * Guardar un nuevo aprendiz
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'apr_PrimerNombre' => 'required|string|max:255',
            'apr_SegundoNombre' => 'nullable|string|max:255',
            'apr_Apellidos' => 'required|string|max:255',
            'apr_TipoDocumento' => 'required|string|max:50',
            'apr_NumeroDocumento' => 'required|string|max:50|unique:tbl_aprendizs,apr_NumeroDocumento',
            'apr_FechaNacimiento' => 'required|date',
            'apr_Direccion' => 'nullable|string|max:255',
            'apr_Telefono' => 'nullable|string|max:20',
            'apr_TelefonoWhatsapp' => 'nullable|string|max:20',
            'apr_CorreoPersonal' => 'nullable|email|max:255',
            'apr_CorreoSena' => 'nullable|email|max:255',
            'apr_SedeFormacion' => 'required|string|max:255',
            'apr_Jornada' => 'required|string|max:50',
            'apr_ModalidadFormacion' => 'required|string|max:50',
            'apr_FechaInicioFormacion' => 'required|date',
            'apr_FechaFinalizacionFormacion' => 'nullable|date',
            'Codigo_programa' => 'required|integer|exists:tbl_programas,prog_codigoPrograma',
            'Codigo_ficha' => 'required|integer|exists:tbl_ficha_caracterizacions,Codigo',
            'Codigo_centro' => 'required|integer|exists:tbl_centro_formacions,Codigo',
            'Codigo_regional' => 'nullable|integer|exists:tbl_regionales,Codigo'
        ]);

        Aprendiz::create($data);

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz creado correctamente');
    }

    /**
     * Formulario para editar un aprendiz
     */
    public function edit($id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        $programas = Programa::all();
        $fichas = FichaCaracterizacion::all();
        $centros = CentroFormacion::all();
        $regionales = Regionale::all();

        return view('aprendices.edit', compact('aprendiz', 'programas', 'fichas', 'centros', 'regionales'));
    }

    /**
     * Actualizar aprendiz
     */
    public function update(Request $request, $id)
    {
        $aprendiz = Aprendiz::findOrFail($id);

        $data = $request->validate([
            'apr_PrimerNombre' => 'required|string|max:255',
            'apr_SegundoNombre' => 'nullable|string|max:255',
            'apr_Apellidos' => 'required|string|max:255',
            'apr_TipoDocumento' => 'required|string|max:50',
            'apr_NumeroDocumento' => "required|string|max:50|unique:tbl_aprendizs,apr_NumeroDocumento,$id,Codigo",
            'apr_FechaNacimiento' => 'required|date',
            'apr_Direccion' => 'nullable|string|max:255',
            'apr_Telefono' => 'nullable|string|max:20',
            'apr_TelefonoWhatsapp' => 'nullable|string|max:20',
            'apr_CorreoPersonal' => 'nullable|email|max:255',
            'apr_CorreoSena' => 'nullable|email|max:255',
            'apr_SedeFormacion' => 'required|string|max:255',
            'apr_Jornada' => 'required|string|max:50',
            'apr_ModalidadFormacion' => 'required|string|max:50',
            'apr_FechaInicioFormacion' => 'required|date',
            'apr_FechaFinalizacionFormacion' => 'nullable|date',
            'Codigo_programa' => 'required|integer|exists:tbl_programas,prog_codigoPrograma',
            'Codigo_ficha' => 'required|integer|exists:tbl_ficha_caracterizacions,Codigo',
            'Codigo_centro' => 'required|integer|exists:tbl_centro_formacions,Codigo',
            'Codigo_regional' => 'nullable|integer|exists:tbl_regionales,Codigo'
        ]);

        $aprendiz->update($data);

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz actualizado correctamente');
    }

    /**
     * Eliminar aprendiz
     */
    public function destroy($id)
    {
        $aprendiz = Aprendiz::findOrFail($id);
        $aprendiz->delete();

        return redirect()->route('aprendices.index')->with('success', 'Aprendiz eliminado correctamente');
    }
}
