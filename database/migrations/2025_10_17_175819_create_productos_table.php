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
            $table->id(); // Crea id como BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('nombre');
            $table->string('codigo')->unique(); // 🔹 Evita duplicados
            $table->unsignedBigInteger('id_imagen')->nullable();
            $table->string('descripcion');
            $table->integer('stock');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->unsignedBigInteger('id_proveedor')->nullable();

            // 🔹 Relaciones foráneas
            $table->foreign('id_imagen')->references('id')->on('imagenes')->onDelete('set null');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('set null');

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
