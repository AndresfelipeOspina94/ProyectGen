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
    
    public function index()
    {
        $proyectos = Proyecto::all();

        return Inertia::render('Proyectos/index', [
            'proyectos' => $proyectos->map(function ($proyecto) {
                return [
                    'id' => $proyecto->id,
                    'nombre' => $proyecto->nombre,
                    'descripcion' => $proyecto->descripcion,
                    'fecha_inicio' => Carbon::parse($proyecto->fecha_inicio)->format('Y-m-d'),
                    'fecha_fin' => Carbon::parse($proyecto->fecha_fin)->format('Y-m-d'),
                    'estado' => $proyecto->estado
                ];
            })
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
        //
    }
}
