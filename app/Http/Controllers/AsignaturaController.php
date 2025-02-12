<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignatura;
use App\Models\profesor;

class AsignaturaController extends Controller
{
    // Obtener todas las asignaturas
    public function index()
    {
        $asignatura = asignatura::all();
        return response()->json($asignatura);
    }

    // Obtener un asignatura por ID
    public function show($id)
    {
        $asignatura = asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrado'], 404);
        }

        return response()->json($asignatura);
    }

    // Crear una nueva asignatura
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:32',
            'profesor_id' => 'required|exists:profesor,id'
        ]);

        $asignatura = asignatura::create($validated);

        return response()->json($asignatura, 201);
    }

    // Modificar una asignatura
    public function update(Request $request, $id)
    {
        $asignatura = asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:32',
            'profesor_id' => 'required|exists:profesor,id'. $id,
        ]);

        $asignatura->update($validated);

        return response()->json($asignatura);
    }

    // Borrar un alumno
    public function destroy($id)
    {
        $asignatura = asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrado'], 404);
        }

        $asignatura->delete();

        return response()->json(['message' => 'Asignatura eliminado']);
    }
        // Obtener un profesor por ID
    public function showProfesor($id)
    {
        $asignatura = Asignatura::with('profesor')->findOrFail($id);
        $profesor = $asignatura->profesor;
    
        return response()->json([
            'asignatura' => $asignatura,
            'profesor' => $profesor,
        ]);
    }
}
