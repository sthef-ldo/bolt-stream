<?php

namespace App\Http\Controllers;
use App\Models\Califiacion;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function store(Request $request,Pelicula $pelicula)
    {
        $request->validate([
            'calificacion'   => 'required|integer|min:1|max:5',
        ]);
        $usuarioId = Auth::id();

        // crea o actualiza la calificacion de esa pelicula para ese usuario
        Califiacion::updateorCreate(
            [
                'usuario_id'  => $usuarioId,
                'pelicula_id' => $pelicula->id,
            ],
            [
                'calificacion'  => $request->calificacion,
            ],
        );

        return back()->with('success', 'Calificacion actualizado correctamente.');
    }
}
