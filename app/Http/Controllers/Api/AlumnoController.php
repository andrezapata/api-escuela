<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    // LISTAR ALUMNOS
    public function index()
    {
        $alumnos = Alumno::all();

        return response()->json($alumnos);
    }

    // GUARDAR ALUMNO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'dni' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required|email',
            'estado_matricula' => 'required'
        ]);

        $alumno = Alumno::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email' => $request->email,
            'estado_matricula' => $request->estado_matricula
        ]);

        return response()->json([
            'mensaje' => 'Alumno guardado correctamente',
            'alumno' => $alumno
        ], 201);
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $alumno->update($request->all());

        return response()->json([
            'mensaje' => 'Alumno actualizado',
            'alumno' => $alumno
        ]);
    }

    // ELIMINAR
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);

        $alumno->delete();

        return response()->json([
            'mensaje' => 'Alumno eliminado'
        ]);
    }
}