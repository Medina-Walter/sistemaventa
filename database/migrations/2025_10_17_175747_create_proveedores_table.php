<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Usamos ': void' para mejor tipado
    {
        Schema::create('proveedores', function (Blueprint $table) {
            
            // CORRECCIÓN: Usamos solo una clave primaria.
            // Se elige 'id_proveedor' basado en tu código.
            $table->id('id_proveedor'); 
            
            $table->string('nombre', 150);
            $table->string('telefono', 20)->nullable();
            $table->string('email', 100)->nullable()->unique(); // Es buena práctica que el email sea único
            $table->string('direccion', 255)->nullable();
            $table->string('sitio_web', 150)->nullable();
            $table->text('nota')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};