<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    // ------------------------------------------
    // Muestra un listado de todas las películas
    // ------------------------------------------
    public function index()
    {
        // Obtiene todas las películas desde la base de datos
        $peliculas = Pelicula::all();

        // Retorna la vista 'index' dentro del panel de películas,
        // enviando las películas mediante la función compact()
        return view('panel.peliculas.index', compact('peliculas'));
    }

    // ----------------------------------------------------
    // Muestra los detalles de una película específica por ID
    // ----------------------------------------------------
    public function show($id)
    {
        // Busca la película por ID o lanza un error 404 si no existe
        $pelicula = Pelicula::findOrFail($id);

        // Retorna la vista de detalle, pasando la película encontrada
        return view('panel.peliculas.show', compact('pelicula'));
    }

    // ----------------------------------------
    // Devuelve el formulario para crear una película
    // ----------------------------------------
    public function create()
    {
        // Retorna la vista del formulario de creación
        return view('panel.peliculas.create');
    }

    // --------------------------------------------------------
    // Guarda una nueva película en la base de datos
    // --------------------------------------------------------
    public function store(Request $request)
    {
        // Valida los datos del formulario antes de guardarlos
        $pelicula = $request->validate([
            'nombre' => 'required',          // Campo obligatorio
            'descripcion' => 'required',     // Campo obligatorio
            'anio' => 'numeric',             // Debe ser numérico
            'link_trailer' => 'url',         // Debe ser una URL válida
            'link_pelicula' => 'url',        // Debe ser una URL válida
            'portada' => 'text',             // Espera texto, no una imagen
        ]);

        // Crea la película con los datos validados
        Pelicula::create($pelicula);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('peliculas.index')->with('success', 'Pelicula creado correctamente.');
    }

    // ----------------------------------------------------------
    // Devuelve el formulario para editar una película existente
    // ----------------------------------------------------------
    public function edit($id)
    {
        // Busca la película por ID o lanza un error 404 si no existe
        $pelicula = Pelicula::findOrFail($id);

        // Retorna la vista de edición, pasando la película encontrada
        return view('panel.peliculas.edit', compact('pelicula'));
    }

    // -----------------------------------------------------------------------
    // Actualiza una película existente con los datos enviados desde el formulario
    // -----------------------------------------------------------------------
    public function update(Request $request, $id)
    {
        // Busca la película a actualizar o lanza un error si no existe
        $pelicula = Pelicula::findOrFail($id);

        // Valida los campos del formulario
        $datos = $request->validate([
            'nombre'         => 'required',       // Campo obligatorio
            'descripcion'    => 'required',       // Campo obligatorio
            'anio'           => 'numeric',        // Debe ser numérico
            'link_trailer'   => 'url',            // Debe ser una URL válida
            'link_pelicula'  => 'url',            // Debe ser una URL válida
            'portada'        => 'nullable|string', // Opcional, texto
        ]);

        // Actualiza la película con los nuevos datos
        $pelicula->update($datos);

        // Redirige al listado con un mensaje de éxito
        return redirect()
            ->route('peliculas.index')
            ->with('success', 'Pelicula actualizado correctamente.');
    }

    // ----------------------------------------------------------
    // Elimina una película de la base de datos
    // ----------------------------------------------------------
    public function destroy(Pelicula $pelicula)
    {
        // Elimina la película seleccionada
        $pelicula->delete();

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('peliculas.index')->with('success', 'Pelicula eliminado correctamente.');
    }
}
