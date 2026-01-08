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
        Schema::create('estatus', function (Blueprint $table) {
            $table->id();

            //claves foraneas
            $table->foreignId('usuario_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('pelicula_id')
                ->constrained('peliculas')
                ->onDelete('cascade');
                
            $table->enum('estatus', ['vista', 'por_ver', 'abandonada','sin_estatus'])->default('sin_estatus');
            $table->boolean('favorita')->default(0);// Favorita (0 = no, 1 = sí) 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus');
    }
};
