<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria');
            $table->integer('id_subcategoria'); 
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('imagen', 2048);
            $table->decimal('precio', 8, 2);
            $table->integer('stock'); 
            $table->timestamps();

            // Llave foranea
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
