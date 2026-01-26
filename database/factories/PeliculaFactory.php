<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelicula>
 */
class PeliculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true), // Mejor que sentence() para títulos
            'descripcion' => fake()->paragraph(),
            'anio' => fake()->numberBetween(1980, 2026), // Rango realista
            'link_trailer' => 'https://www.youtube.com/watch?v=' . fake()->uuid, // YouTube-like
            'link_pelicula' => 'https://stream.example.com/' . fake()->slug(), // Streaming URL
            'portada' => fake()->imageUrl(),
        ];
    }
}
