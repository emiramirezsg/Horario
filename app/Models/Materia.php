<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre',];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_materia');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docente_materia');
    }
}
