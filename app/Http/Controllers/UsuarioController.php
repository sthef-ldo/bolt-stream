<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios=User::all();
        return view('panel.usuarios.index', compact('usuarios'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
        $usuario=User::findOrFail($id);

        $favoritasPosEstatus = $usuario->estatusPeliculas()
        ->where('favorita', true)
        ->with('pelicula')
        ->orderBy('estatus')
        ->get();
        return view('panel.usuarios.show', compact('usuario', 'favoritasPosEstatus'));
    }
    public function edit($id){}
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id){}
}




/* public function show($id)
{
    $usuario = User::findOrFail($id);

    // favoritas, ordenadas por estatus
    $favoritasPorEstatus = $usuario->estatusPeliculas()
        ->where('favorita', true)
        ->with('pelicula')
        ->orderBy('estatus') // 'abandonada', 'por_ver', 'sin_estatus', 'vista'
        ->get();

    // si quieres, separadas por cada estatus:
    $favoritasVista = $usuario->estatusPeliculas()
        ->where('favorita', true)
        ->where('estatus', 'vista')
        ->with('pelicula')
        ->get();

    $favoritasPorVer = $usuario->estatusPeliculas()
        ->where('favorita', true)
        ->where('estatus', 'por_ver')
        ->with('pelicula')
        ->get();

    $favoritasAbandonada = $usuario->estatusPeliculas()
        ->where('favorita', true)
        ->where('estatus', 'abandonada')
        ->with('pelicula')
        ->get();

    return view('panel.usuarios.show', compact(
        'usuario',
        'favoritasPorEstatus',
        'favoritasVista',
        'favoritasPorVer',
        'favoritasAbandonada',
    ));
} */
