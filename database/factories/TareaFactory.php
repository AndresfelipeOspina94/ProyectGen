<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'proyecto_id' => \App\Models\Proyecto::factory(),
            'nombre' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'prioridad' => $this->faker->randomElement(['alta', 'media', 'baja']),
            'estado' => $this->faker->randomElement(['pendiente', 'en progreso', 'completada']),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date()
        ];
    }
}
