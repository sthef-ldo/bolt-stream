<?php

namespace App\Http\Controllers;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{


// Listado de películas 
public function index() { 
    $peliculas = Pelicula::all(); 
    // Obtiene todas las películas 
    return view('panel.peliculas.index', compact('peliculas'));
 }

// Página para ver los detalles de una película 
public function detalles($id) {
 $pelicula = Pelicula::findOrFail($id); 
return view('panel.peliculas.detalles', compact('pelicula')); }
}
