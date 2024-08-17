<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre'];

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    public function paralelos()
    {
        return $this->hasMany(Paralelo::class);
    }
}
