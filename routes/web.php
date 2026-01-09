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

//prueba
Route::get('/prueba', function(){
    $peliculas = DB::table('peliculas')
        ->get();
    return $peliculas;
});



Route::resource('peliculas', PeliculaController::class);


