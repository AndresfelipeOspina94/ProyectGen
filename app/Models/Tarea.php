<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = ['sprint_id', 'nombre', 'descripcion', 'prioridad', 'estado', 'fecha_inicio', 'fecha_fin'];

    // Pertenece a un Sprint
    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }

    // Tiene muchos Comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}
