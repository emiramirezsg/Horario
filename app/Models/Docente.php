<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = ['nombre', 'apellido', 'email', 'categoria_id', 'user_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function paralelos()
    {
        return $this->belongsToMany(Paralelo::class, 'docente_paralelo');
    }

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'docente_materia');
    }

    public function horarios()
    {
        return $this->hasManyThrough(Horario::class, DocenteMateria::class, 'docente_id', 'docente_materia_id', 'id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
