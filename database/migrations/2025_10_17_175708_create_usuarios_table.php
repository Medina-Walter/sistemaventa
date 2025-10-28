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
        Schema::create('usuarios', function (Blueprint $table) {
            
            // Define la clave primaria. 
            // Si quieres que se llame 'id_usuario', usa id('id_usuario').
            // Si quieres el nombre estándar 'id', usa solo id().
            $table->id('id_usuario'); 
            
            $table->string('nombre', 100);    // Ajustar el tamaño es buena práctica
            $table->string('apellido', 100);
            
            // 'usuario' y 'correo' deben ser únicos
            $table->string('usuario', 50)->unique(); 
            $table->string('correo', 100)->unique();
            
            // Usaremos 'password' en lugar de 'clave' para compatibilidad con Laravel Auth.
            // Los campos de contraseña requieren un tamaño mayor.
            $table->string('password', 255); 
            
            $table->string('rol', 50);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};