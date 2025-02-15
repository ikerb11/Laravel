<?php

use App\Http\Controllers\AlumnoControler;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AuthController;
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

Route::resource('profesor', ProfesorController::class);
Route::get('/profesor', [ProfesorController::class, 'index']);      // Obtener todos
Route::get('/profesor/{id}', [ProfesorController::class, 'show']);  // Obtener por ID
Route::post('/profesor', [ProfesorController::class, 'store']);     // Crear
Route::put('/profesor/{id}', [ProfesorController::class, 'update'])->middleware(EnsureIDIsValid::class);; // Modificar
Route::delete('/profesor/{id}', [ProfesorController::class, 'destroy']); // Borrar

Route::resource('asignatura', AsignaturaController::class);
Route::get('/asignatura', [AsignaturaController::class, 'index']);      // Obtener todos
Route::get('/asignatura/{id}', [AsignaturaController::class, 'show']);  // Obtener por ID
Route::post('/asignatura', [AsignaturaController::class, 'store']);     // Crear
Route::put('/asignatura/{id}', [AsignaturaController::class, 'update'])->middleware(EnsureIDIsValid::class);; // Modificar
Route::delete('/asignatura/{id}', [AsignaturaController::class, 'destroy']); // Borrar
Route::delete('/asignatura_profesor/{id}', [AsignaturaController::class, 'showProfesor']); // Mostrar asignatura con profesor


// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::get('/public-endpoint', function () {
    return response()->json(['message' => 'Esta es una ruta pública']);
    });

    Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});





