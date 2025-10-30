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
        Schema::create('detalle_venta', function (Blueprint $table) {   
            // CORRECCIÓN 1: Eliminamos la clave primaria duplicada ($table->id()).
            // Mantenemos 'id_detalle' como la única clave primaria.
            $table->id(); 
            // 1. Definición de las columnas foráneas
            $table->unsignedBigInteger('id_venta');
            $table->unsignedBigInteger('id_producto');
            $table->foreignId('id_venta')->constrained('ventas')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('sub_total', 10, 2);
            
            $table->timestamps();
            
            // 2. Definición de las claves foráneas (ajustadas a tus nombres de columnas)
            
            // CORREGIDO: Referencia a la clave 'id_venta' en la tabla 'ventas'.
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            
            // CORREGIDO: Referencia a la clave 'id_producto' en la tabla 'productos'.
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};