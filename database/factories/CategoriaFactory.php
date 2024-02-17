<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        return [
            'nombre' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'descripcion' => $this->faker->paragraph(),
            'imagen' => $this->faker->image('public/storage/categorias', 640, 480, null, false)
        ];
    }
}
