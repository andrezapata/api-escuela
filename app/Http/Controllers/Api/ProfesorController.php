<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::all();
        return response()->json($profesores);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'dni' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required|email',
            'especialidad' => 'required',
        ]);

        $profesor = Profesor::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email' => $request->email,
            'especialidad' => $request->especialidad,
        ]);

        return response()->json([
            'mensaje' => 'Profesor guardado correctamente',
            'profesor' => $profesor
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->update($request->all());
        return response()->json([
            'mensaje' => 'Profesor actualizado',
            'profesor' => $profesor
        ]);
    }

    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        return response()->json(['mensaje' => 'Profesor eliminado']);
    }
}