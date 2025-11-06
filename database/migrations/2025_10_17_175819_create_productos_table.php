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
            $table->id('id_producto'); // Es buena práctica darle nombre, ya que usas ID específicos
            $table->string('nombre', 150);
            $table->string('codigo', 50)->unique();
            $table->text('descripcion')->nullable(); // Una descripción suele ser más larga que un string
            $table->integer('stock')->default(0); // El stock inicial puede ser 0
            $table->decimal('precio_compra', total: 10, 2);
            $table->decimal('precio_venta', 10, 2);
            
            // 🔹 Claves Foráneas (solo columnas de definición)
            $table->unsignedBigInteger('id_imagen')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->unsignedBigInteger('id_proveedor')->nullable();

            // 🔹 Relaciones foráneas CORREGIDAS
            
            // La tabla 'imagenes' probablemente usa el 'id' estándar de Laravel, lo mantenemos.
            $table->foreign('id_imagen')->references('id')->on('imagenes')->onDelete('set null');
            
            // CORREGIDO: Apunta a 'id_categoria' en la tabla 'categorias'.
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('set null');
            
            // CORREGIDO: Apunta a 'id_proveedor' en la tabla 'proveedores'.
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('set null');
            
            $table->timestamps();
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