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
            
            // CORRECCIÓN: Usamos solo una clave primaria auto-incrementable.
            // Se mantiene 'id_venta' como el nombre de la PK.
            $table->id('id_venta'); 
            
            // 1. Definición de la columna para la clave foránea
            $table->unsignedBigInteger('id_usuario');
            
            $table->decimal('total_venta', 10, 2);
            
            $table->timestamps();
            
            // 2. Definición de la clave foránea (ajustada a tus nombres de columnas)
            // Esto asume que la clave primaria en la tabla 'usuarios' se llama 'id_usuario'.
            $table->foreign('id_usuario')
                  ->references('id_usuario') 
                  ->on('usuarios')
                  ->onDelete('restrict'); // Mejor usar 'restrict' o 'set null' en ventas que 'cascade'
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