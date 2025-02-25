<?php

use App\Http\Controllers\AlumnoControler;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;

// Rutas de API protegidas con CheckAuth
Route::middleware(['check.auth'])->group(function () {
    Route::resource('alumnos', AlumnoControler::class)->except(['create', 'edit']);
    Route::resource('profesor', ProfesorController::class)->except(['create', 'edit']);
    Route::resource('asignatura', AsignaturaController::class)->except(['create', 'edit']);
    Route::delete('/asignatura_profesor/{id}', [AsignaturaController::class, 'showProfesor']);
});

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::get('/public-endpoint', function () {
    return response()->json(['message' => 'Esta es una ruta pública']);
});

// Rutas protegidas por autenticación Passport
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/logout', function (Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    });
});

// Autenticación con Passport (OAuth)
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])
    ->middleware(['throttle']);
