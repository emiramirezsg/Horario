<?php
namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Periodo;
use App\Models\DocenteMateria;
use App\Models\Aula;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['periodo', 'docenteMateria', 'aula'])->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $periodos = Periodo::all();
        $docenteMaterias = DocenteMateria::all();
        $aulas = Aula::all();
        return view('horarios.create', compact('periodos', 'docenteMaterias', 'aulas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'horas' => 'required',
            'periodo_id' => 'required|exists:periodos,id',
            'docente_materia_id' => 'required|exists:docente_materia,id',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        Horario::create($validated);

        return redirect()->route('horarios.index');
    }

    public function show(Horario $horario)
    {
        return view('horarios.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        $periodos = Periodo::all();
        $docenteMaterias = DocenteMateria::all();
        $aulas = Aula::all();
        return view('horarios.edit', compact('horario', 'periodos', 'docenteMaterias', 'aulas'));
    }

    public function update(Request $request, Horario $horario)
    {
        $validated = $request->validate([
            'horas' => 'required',
            'periodo_id' => 'required|exists:periodos,id',
            'docente_materia_id' => 'required|exists:docente_materia,id',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        $horario->update($validated);

        return redirect()->route('horarios.index');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index');
    }
}
