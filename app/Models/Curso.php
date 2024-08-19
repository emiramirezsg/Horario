<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre'];

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'materia_curso')
                    ->withPivot('cantidad_horas_semanales');
    }

    public function paralelos()
    {
        return $this->hasMany(Paralelo::class);
    }
}
