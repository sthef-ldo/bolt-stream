<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'anio',
        'link_trailer',
        'link_pelicula',
        'portada',
    ];

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'peliculas_generos', 'pelicula_id', 'genero_id');
    }

    public function estatus(){
        return $this->hasMany(Estatus::class, 'pelicula_id');
    }
    public function calificaciones(){
        return $this->hasMany(Califiacion::class, 'pelicula_id');
    }



    public function promedioCalificacion()
    {
        $promedio = $this->calificaciones()->avg('calificacion');
        return $promedio ? round($promedio, 2) : 0;
    }
}
