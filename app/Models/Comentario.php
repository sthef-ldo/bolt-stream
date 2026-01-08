<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
     protected $fillable = [
        'comentario',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function peliculas(){
        return $this->belongsTo(Pelicula::class);
    }
}
