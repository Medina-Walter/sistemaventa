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
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_barra');   // Código de barra del producto
            $table->string('nombre');         // Nombre del producto
            $table->integer('cantidad');      // Cantidad en el carrito
            $table->decimal('precio', 10, 2); // Precio unitario
            $table->timestamps();             // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};

