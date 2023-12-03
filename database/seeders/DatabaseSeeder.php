<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\User;
use Database\Factories\CategoriaFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            
            'name' => 'Programador',          
            'email' => 'ospnetsistemas2006@gmail.com',
            'email_verified_at' => now(),           
            'password' => bcrypt('v-41328029'), // password
            'remember_token' => Str::random(10),

        ]);

        Storage::disk('public')->deleteDirectory('categorias');
        Storage::disk('public')->makeDirectory('categorias');

        Categoria::factory(3)->create();

    }
}
