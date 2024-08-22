<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre'];

    public function materias()
    {
    return $this->belongsToMany(Materia::class, 'curso_materia');
    }

    public function paralelos()
    {
        return $this->hasMany(Paralelo::class);
    }
}
