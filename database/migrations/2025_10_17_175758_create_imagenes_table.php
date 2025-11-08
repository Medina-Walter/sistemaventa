<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Es buena práctica usar ': void' en Laravel 10+
    {
        Schema::create('imagenes', function (Blueprint $table) {      
            $table->id(); 
            $table->string('nombre', 255);
            $table->string('ruta', 255);
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