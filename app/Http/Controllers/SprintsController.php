<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SprintsController extends Controller
{
    public function index()
    {
        $sprints = Sprint::with('proyecto')->get();

        return Inertia::render('Sprints/Index', [
            'sprints' => $sprints
        ]);
    }

    public function create()
    {
        return Inertia::render('Sprints/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'proyecto_id' => 'required|exists:proyectos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        Sprint::create($request->all());

        return redirect()->route('sprints.index')->with('success', 'Sprint creado exitosamente.');
    }

    public function show(Sprint $sprint)
    {
        return Inertia::render('Sprints/Show', [
            'sprint' => $sprint
        ]);
    }

    public function edit(Sprint $sprint)
    {
        return Inertia::render('Sprints/Edit', [
            'sprint' => $sprint
        ]);
    }

    public function update(Request $request, Sprint $sprint)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'proyecto_id' => 'required|exists:proyectos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

        $sprint->update($request->all());

        return redirect()->route('sprints.index')->with('success', 'Sprint actualizado exitosamente.');
    }

    public function destroy(Sprint $sprint)
    {
        $sprint->delete();

        return redirect()->route('sprints.index')->with('success', 'Sprint eliminado exitosamente.');
    }
}
