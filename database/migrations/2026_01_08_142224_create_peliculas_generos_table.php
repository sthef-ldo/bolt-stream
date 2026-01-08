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
        Schema::create('peliculas_generos', function (Blueprint $table) {
            $table->id();

            $table->integer('genero_id');
            $table->integer('pelicula_id');

            //claves foraneas (genero_id->generos[id] y pelicula_id->peliculas[id])
            $table->foreignId('pelicula_id')
                ->constrained('peliculas')
                ->onDelete('cascade');
            $table->foreignId('genero_id')
                ->constrained('generos')
                ->onDelete('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas_generos');
    }
};
