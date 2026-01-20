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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();

            //claves foraneas (usuario_id->users[id] y pelicula_id->peliculas[id])
            $table->foreignId('usuario_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('pelicula_id')
                ->constrained('peliculas')
                    ->onDelete('cascade');

            $table->integer('calificacion')
                ->check('calificacion BETWEEN 1 AND 10')
                ->default(1);
            
            // Índice único (usuario + película) 
            $table->unique(['usuario_id', 'pelicula_id'], 'unica_pelicula_usuario');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
