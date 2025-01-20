<?php

namespace App\Http\Controllers;

use App\Models\alumno;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class AlumnoControler extends Controller
{
    // Obtener todos los alumnos
    public function index()
    {
        $alumnos = Alumno::all();
        return response()->json($alumnos);
    }

    // Obtener un alumno por ID
    public function show($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json($alumno);
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

        $alumno = Alumno::create($validated);

        return response()->json($alumno, 201);
    }

    // Modificar un alumno
    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
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

        $alumno->update($validated);

        return response()->json($alumno);
    }

    // Borrar un alumno
    public function destroy($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $alumno->delete();

        return response()->json(['message' => 'Alumno eliminado']);
    }
}
