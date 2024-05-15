<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado'];
    protected $dates = ['fecha_inicio', 'fecha_fin'];


    // Relación con Sprints
    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }

    // Relación con Tareas a través de Sprints
    public function tareas()
    {
        return $this->hasManyThrough(Tarea::class, Sprint::class);
    }

}
