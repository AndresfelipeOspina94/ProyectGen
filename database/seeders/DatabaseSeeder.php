<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use App\Models\Sprint;
use App\Models\Tarea;
use App\Models\Comentario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Proyecto::factory(10)->create()->each(function ($proyecto) {
            // Cada proyecto tiene sprints asociados
            Sprint::factory(5)->create(['proyecto_id' => $proyecto->id])->each(function ($sprint) {
                // Cada sprint puede tener varias tareas
                Tarea::factory(7)->create(['sprint_id' => $sprint->id])->each(function ($tarea) {
                    // Cada tarea puede tener varios comentarios
                    Comentario::factory(3)->create(['tarea_id' => $tarea->id]);
                });
            });
        }); 
    }
}
