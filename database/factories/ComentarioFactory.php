<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tarea_id' => \App\Models\Tarea::factory(),
            'usuario_id' => \App\Models\User::factory(),
            'contenido' => $this->faker->paragraph,
        ];
    }
}
