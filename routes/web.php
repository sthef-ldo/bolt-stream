<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\PeliculaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas para las peliculas
Route::resource('peliculas', PeliculaController::class);


use App\Http\Controllers\EstatusController;

Route::middleware('auth')->group(function () {
    Route::post('/peliculas/{pelicula}/estatus', [EstatusController::class, 'store'])
        ->name('peliculas.estatus.store');
});


/* Route::get('/prueba', function(){
    $peliculas = DB::table('peliculas')
        ->get();
    return $peliculas;
});

 */


