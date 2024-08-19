<?php
namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Materia;
use App\Models\Paralelo;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        $cursos = Curso::with('paralelos')->get();
        return view('cursos.index', compact('cursos','materias'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Curso::create($validated);

        return redirect()->route('cursos.index');
    }

    public function show(Curso $curso)
    {
        // Cargar el curso con paralelos
        $curso->load('paralelos');
        return view('cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.index');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index');
    }
    public function asignarMaterias(Request $request, $curso_id)
{
    $curso = Curso::findOrFail($curso_id);
    $materias = $request->input('materias');
    $curso->materias()->sync($materias);

    return redirect()->route('cursos.index')->with('success', 'Materias asignadas correctamente');
}


}
