<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Se agrega ': void' para mejor tipado
    {
        Schema::create('categorias', function (Blueprint $table) {
            // CORRECCIÓN: Se elimina $table->id() duplicado.
            // Se mantiene una única clave primaria auto-incrementable con el nombre 'id_categoria'.
            $table->id('id_categoria'); 
            $table->string('nombre', 100)->unique(); // Es buena práctica definir el tamaño y que sea única.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};