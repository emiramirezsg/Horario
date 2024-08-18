<?php
namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\User; // Asegúrate de incluir el modelo User si lo necesitas
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all(); // Obtener todos los horarios

        // Si necesitas pasar el usuario, por ejemplo, el usuario autenticado
        $user = auth()->user(); // Obtener el usuario autenticado

        return view('horarios.index', compact('horarios', 'user'));
    }
}
