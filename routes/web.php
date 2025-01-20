<?php

use App\Http\Controllers\AlumnoControler;
use App\Http\Middleware\EnsureIDIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('alumnos', AlumnoControler::class);
Route::get('/alumnos', [AlumnoControler::class, 'index']);      // Obtener todos
Route::get('/alumnos/{id}', [AlumnoControler::class, 'show']);  // Obtener por ID
Route::post('/alumnos', [AlumnoControler::class, 'store']);     // Crear
Route::put('/alumnos/{id}', [AlumnoControler::class, 'update'])->middleware(EnsureIDIsValid::class);; // Modificar
Route::delete('/alumnos/{id}', [AlumnoControler::class, 'destroy']); // Borrar
