<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;
    protected $fillable = ['proyecto_id', 'nombre', 'descripcion', 'fecha_inicio', 'fecha_fin'];

    // Pertenece a un Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    // Tiene muchas Tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
