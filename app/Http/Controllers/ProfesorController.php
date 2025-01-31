<?php

namespace App\Http\Controllers;

use App\Models\profesor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class ProfesorController extends Controller
{
    // Obtener todos los profesores
    public function index()
    {
        $profesor = Profesor::all();
        return response()->json($profesor);
    }

    // Obtener un profesor por ID
    public function show($id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['error' => 'Profesor no encontrado'], 404);
        }

        return response()->json($profesor);
    }

    // Crear un nuevo alumno
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:32',
            'telefono' => 'string|max:16',
            'edad' => 'integer|min:1',
            'password' => 'string|max:64',
            'correo' => 'required|email|unique:alumnos',
            'sexo' => 'string|max:1',
        ]);

        $profesor = Profesor::create($validated);

        return response()->json($profesor, 201);
    }

    // Modificar un alumno
    public function update(Request $request, $id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:32',
            'telefono' => 'string|max:16',
            'edad' => 'integer|min:1',
            'password' => 'string|max:64',
            'correo' => 'required|email|unique:alumnos',
            'sexo' => 'string|max:1'. $id,
        ]);

        $profesor->update($validated);

        return response()->json($profesor);
    }

    // Borrar un alumno
    public function destroy($id)
    {
        $profesor = Profesor::find($id);

        if (!$profesor) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $profesor->delete();

        return response()->json(['message' => 'Alumno eliminado']);
    }
}
