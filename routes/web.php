<?php

use App\Http\Controllers\AlumnoControler;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureIDIsValid;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

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

//Rutas Passport

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Http\Controllers\AccessTokenController;


Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);

    // Permitir login por email o nombre
    $user = User::where('email', $credentials['email'])
                ->orWhere('name', $credentials['email'])
                ->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    $token = $user->createToken('API Token')->accessToken;

    return response()->json(['token' => $token], 200);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json($request->user());
});
Route::middleware('auth:api')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    
    return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
});
Route::middleware('auth:api')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    
    return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
});
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])
    ->middleware(['throttle']);







