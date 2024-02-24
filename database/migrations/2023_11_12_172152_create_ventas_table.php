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
            $table->unsignedBigInteger('id_user');
            $table->string('tipo_pago');
            $table->string('referencia');      
            $table->string('banco');
            $table->string('fecha');   
            $table->string('codigo'); 
            $table->string('telf'); 
            $table->decimal('impuesto', 8, 2);
            $table->decimal('total', 8, 2); 
            $table->integer('estado');  
            $table->timestamps();

             // Llave foranea
             $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
