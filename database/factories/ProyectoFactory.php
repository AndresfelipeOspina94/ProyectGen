<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['activo', 'completado', 'en pausa'])
        ];
    }
}
