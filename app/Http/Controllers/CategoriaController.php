<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validación para permitir un número entero para horas de trabajo
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'hrs_trabajo' => ['required', 'integer', 'min:0', 'max:999'], // Permitir de 0 a 999 horas
            'dias_libres' => 'required|string|max:255',
        ]);

        // Convertir hrs_trabajo en formato de horas para guardar
        $validated['hrs_trabajo'] = $validated['hrs_trabajo'] . ' horas';

        Categoria::create($validated);

        return redirect()->route('categorias.index');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        // Validación para permitir un número entero para horas de trabajo
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'hrs_trabajo' => ['required', 'integer', 'min:0', 'max:999'], // Permitir de 0 a 999 horas
            'dias_libres' => 'required|string|max:255',
        ]);

        // Convertir hrs_trabajo en formato de horas para guardar
        $validated['hrs_trabajo'] = $validated['hrs_trabajo'] . ' horas';

        $categoria->update($validated);

        return redirect()->route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
