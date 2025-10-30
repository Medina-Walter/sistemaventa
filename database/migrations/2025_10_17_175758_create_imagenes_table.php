<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Es buena práctica usar ': void' en Laravel 10+
    {
        Schema::create('imagenes', function (Blueprint $table) {      
            // Opción 1: Usar el método 'id()' estándar para la clave primaria
            $table->id(); 
            
            // Si quieres que la columna se llame 'id_imagen' puedes usar:
            // $table->id('id_imagen'); 
            
            $table->string('nombre', 255);
            $table->string('ruta', 255);
            $table->timestamps();
        });
    } // <--- Este corchete cierra el método public function up()

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};