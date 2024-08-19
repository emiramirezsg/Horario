<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre',];

    public function curso()
    {
        return $this->belongsToMany(Curso::class, 'materia_curso')
                    ->withPivot('cantidad_horas_semanales');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docente_materia');
    }
}
