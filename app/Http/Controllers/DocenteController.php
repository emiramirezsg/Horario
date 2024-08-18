<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // Validar la solicitud
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'categoria_id' => 'required|exists:categorias,id',
            'password' => 'required|string|min:8|confirmed', // Validar la contraseña
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_docente' => true, // Marcar como docente
        ]);

        // Crear el docente
        Docente::create([
            'user_id' => $user->id, // Asocia el docente con el usuario
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'categoria_id' => $validated['categoria_id'],
        ]);

        return redirect()->route('docentes.index')->with('success', 'Docente creado con éxito.');
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
        // Validar la solicitud
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $docente->user_id,
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        // Actualizar el usuario
        $user = User::findOrFail($docente->user_id);
        $user->update([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
        ]);

        // Actualizar el docente
        $docente->update([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'categoria_id' => $validated['categoria_id'],
        ]);

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado con éxito.');
    }

    public function destroy(Docente $docente)
    {
        // Eliminar el usuario asociado
        $user = User::findOrFail($docente->user_id);
        $user->delete();

        // Eliminar el docente
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado con éxito.');
    }
    public function horarios()
    {
        $user = Auth::user();
        $docente = Docente::where('user_id', $user->id)->first();
        
        if (!$docente) {
            return redirect()->route('home')->with('error', 'No se encontró el docente asociado.');
        }

        $horarios = $docente->horarios; // Asegúrate de tener una relación definida en el modelo Docente

        return view('docentevista.index', compact('horarios'));
    }
}
