<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstatusController extends Controller
{
    public function store(Request $request, Pelicula $pelicula)
    {
        $request->validate([
            'estatus'   => 'required|in:vista,por_ver,abandonada,sin_estatus',
            'favorita'  => 'nullable|boolean',
        ]);

        $usuarioId = Auth::id();

        // crea o actualiza el estatus de esa película para ese usuario
        Estatus::updateOrCreate(
            [
                'usuario_id'  => $usuarioId,
                'pelicula_id' => $pelicula->id,
            ],
            [
                'estatus'  => $request->estatus,
                'favorita' => $request->boolean('favorita'),
            ]
        );

        return back()->with('success', 'Estatus actualizado correctamente.');
    }
}
