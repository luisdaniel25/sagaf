<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructorRequest;
use App\Models\Competencia;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Vigencia;
use App\Services\InstructorService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class InstructorController extends Controller
{
    public function __construct(
        private readonly InstructorService $service
    ) {
    }

    public function index(): View
    {
        $instructores = Instructor::query()
            ->with([
                'vigencia',
                'user'
            ])
            ->paginate(15);

        return view(
            'instructores.index',
            compact('instructores')
        );
    }

    public function create(): View
    {
        return view(
            'instructores.create',
            $this->catalogos()
        );
    }

    public function store(
        InstructorRequest $request
    ): RedirectResponse {

        $this->service->store(
            $request->validated(),
            $request->input('competencias', [])
        );

        return redirect()
            ->route('instructores.index')
            ->with(
                'success',
                'Instructor creado correctamente.'
            );
    }

    public function show(
        Instructor $instructor
    ): View {

        $instructor->load([
            'vigencia',
            'user',
            'competencias'
        ]);

        return view(
            'instructores.show',
            compact('instructor')
        );
    }

    public function edit(
        Instructor $instructor
    ): View {

        return view(
            'instructores.edit',
            array_merge(
                [
                    'instructor' => $instructor
                ],
                $this->catalogos($instructor)
            )
        );
    }

    public function update(
        InstructorRequest $request,
        Instructor $instructor
    ): RedirectResponse {

        $this->service->update(
            $instructor,
            $request->validated(),
            $request->input('competencias', [])
        );

        return redirect()
            ->route('instructores.index')
            ->with(
                'success',
                'Instructor actualizado correctamente.'
            );
    }

    public function destroy(
        Instructor $instructor
    ): RedirectResponse {

        $this->service->delete(
            $instructor
        );

        return redirect()
            ->route('instructores.index')
            ->with(
                'success',
                'Instructor eliminado correctamente.'
            );
    }

    public function competencias(
        Instructor $instructor
    ): View {

        $instructor->load('competencias');

        $competencias = Competencia::orderBy(
            'comp_Denominacion'
        )->get();

        return view(
            'instructores.competencias',
            compact(
                'instructor',
                'competencias'
            )
        );
    }

    private function catalogos(
        ?Instructor $instructor = null
    ): array {

        $usuarios = User::query()
            ->when(
                $instructor,
                fn($query) => $query->whereDoesntHave(
                    'instructor'
                )->orWhere(
                    'id',
                    $instructor->Codigo_usuario
                ),
                fn($query) => $query->whereDoesntHave(
                    'instructor'
                )
            )
            ->get();

        return [
            'vigencias' => Vigencia::orderBy(
                'vig_anio'
            )->get(),

            'competencias' => Competencia::orderBy(
                'comp_Denominacion'
            )->get(),

            'usuarios' => $usuarios,
        ];
    }
}
