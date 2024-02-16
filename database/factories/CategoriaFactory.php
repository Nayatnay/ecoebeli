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
        $name = $this->faker->name();
        return [
            'nombre' => $name,
            'slug' => Str::slug($name, '-'),
            'descripcion' => $this->faker->name(),
            'imagen' => $this->faker->image('public/storage/categorias', 640, 480, null, false)
        ];
    }
}
