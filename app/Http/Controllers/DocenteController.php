<?php
namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Categoria;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('categoria')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('docentes.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Docente::create($validated);

        return redirect()->route('docentes.index');
    }

    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        $categorias = Categoria::all();
        return view('docentes.edit', compact('docente', 'categorias'));
    }

    public function update(Request $request, Docente $docente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $docente->update($validated);

        return redirect()->route('docentes.index');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();

        return redirect()->route('docentes.index');
    }
}
