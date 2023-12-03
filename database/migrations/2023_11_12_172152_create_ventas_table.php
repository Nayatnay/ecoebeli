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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo_comprobante');
            $table->string('serie_comprobante');      
            $table->string('num_comprobante');
            $table->string('fecha');   
            $table->decimal('impuesto', 8, 2);
            $table->decimal('total', 8, 2); 
            $table->integer('estado');  
            $table->timestamps();

             // Llave foranea
             $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
