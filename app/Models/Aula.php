<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = ['nombre', 'cantidad_aulas'];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
