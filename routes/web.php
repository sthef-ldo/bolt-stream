<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//prueba
Route::get('/prueba', function(){
    $peliculas = DB::table('peliculas')
        ->get();
    return $peliculas;
});



use App\Http\Controllers\PeliculaController;

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::get('/peliculas/{id}', [PeliculaController::class, 'detalles'])->name('peliculas.detalles');

