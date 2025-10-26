<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->decimal('precio', 8, 2);
        $table->integer('stock');

        // Si el producto tiene imagen opcional:
        $table->unsignedBigInteger('id_imagen')->nullable();

        $table->foreign('id_imagen')
              ->references('id')
              ->on('imagenes')
              ->onDelete('set null');

        $table->timestamps();
    });
}

    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->foreignId('id_imagen')->nullable()->constrained('imagenes')->onDelete('set null');
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('id_proveedor')->nullable()->constrained('proveedores')->onDelete('set null');
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
