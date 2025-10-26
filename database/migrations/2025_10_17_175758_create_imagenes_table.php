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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id(); // <--- tipo BIGINT UNSIGNED automáticamente

    {   
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->string('nombre');
            $table->string('ruta');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
