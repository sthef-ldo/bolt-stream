<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
     protected $fillable = [
        'estatus',
        'favorita',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function peliculas(){
        return $this->belongsTo(Pelicula::class);
    }
}
