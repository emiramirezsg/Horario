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
        $materias = Materia::all(); 
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        return view('materias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
        ]);

        Materia::create($validatedData);

        return redirect()->route('materias.index')->with('success', 'Materia creada exitosamente.');
    }

    public function show(Materia $materia)
    {
        $materia->load('docente'); // Usa `load` para evitar consultas adicionales
        $docentes = Docente::all(); // Si necesitas mostrar todos los docentes

        return view('materias.show', compact('materia', 'docentes'));
    }

    public function edit(Materia $materia)
    {
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $validated = $request->validate([
            'nombre' => 'required',
        ]);

        $materia->update($validated);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada exitosamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
