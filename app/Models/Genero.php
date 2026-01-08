<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
     protected $fillable = [
        'nombre',
    ];

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'peliculas_generos', 'genero_id', 'pelicula_id');
    }
}
