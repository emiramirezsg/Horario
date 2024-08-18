<?php
namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with('curso', 'docente')->get();
        $cursos = Curso::all(); // Obtener todos los cursos
        $docentes = Docente::all(); // Obtener todos los docentes

        return view('materias.index', compact('materias', 'cursos', 'docentes'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('materias.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Materia::create($validated);

        return redirect()->route('materias.index');
    }

    public function show(Materia $materia)
    {
        return view('materias.show', compact('materia'));
    }

    public function edit(Materia $materia)
    {
        $cursos = Curso::all();
        return view('materias.edit', compact('materia', 'cursos'));
    }

    public function update(Request $request, Materia $materia)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $materia->update($validated);

        return redirect()->route('materias.index');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('materias.index');
    }
}
