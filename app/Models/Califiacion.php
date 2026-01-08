<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Califiacion extends Model
{
    //
     protected $fillable = [
        'calificacion',
    ];

    public function users() {
        return $this->belongsTo(User::class); 
    }
    public function peliculas() {
        return $this->belongsTo(Pelicula::class); 
    }
}
