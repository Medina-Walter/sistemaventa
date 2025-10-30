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
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
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