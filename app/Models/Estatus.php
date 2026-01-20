<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    protected $table = 'estatus';
     protected $fillable = [
        'usuario_id',
        'pelicula_id',
        'estatus',
        'favorita'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function pelicula(){
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }
}
