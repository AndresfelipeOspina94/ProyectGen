<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Comentario;
use App\Models\Sprint;
use App\Models\Tarea;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProyectosController extends Controller
{
    
    public function index(Request $request) 
    {
        $proyectos = Proyecto::with('tareas')->paginate(15);

    return Inertia::render('Proyectos/index', [
        'proyectos' => $proyectos->map(function ($proyecto) {
            return [
                'id' => $proyecto->id,
                'nombre' => $proyecto->nombre,
                'descripcion' => $proyecto->descripcion,
                'fecha_inicio' => $proyecto->fecha_inicio ? ($proyecto->fecha_inicio instanceof Carbon ? $proyecto->fecha_inicio->format('Y-m-d') : $proyecto->fecha_inicio) : 'Fecha no disponible',
                'fecha_fin' => $proyecto->fecha_fin ? ($proyecto->fecha_fin instanceof Carbon ? $proyecto->fecha_fin->format('Y-m-d') : $proyecto->fecha_fin) : 'Fecha no disponible',
                'estado' => $proyecto->estado,
                'tareas' => $proyecto->tareas->map(function ($tarea) {
                    return [
                        'nombre' => $tarea->nombre,
                        'descripcion' => $tarea->descripcion,
                    ];
                }),
            ];
        }),
    ]);        
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Proyecto $proyecto)
    {
        //
    }

    
    public function edit(Proyecto $proyecto)
    {
        //
    }

    
    public function update(Request $request, Proyecto $proyecto)
    {
        //
    }

   
    public function destroy(Proyecto $proyecto)
    {
        
    }
}
