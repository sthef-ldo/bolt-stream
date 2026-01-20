<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Califiacion extends Model
{
    protected $table = 'calificaciones';
    protected $fillable = [
        'usuario_id',
        'pelicula_id',
        'calificacion'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function peliculas()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }

    
}
