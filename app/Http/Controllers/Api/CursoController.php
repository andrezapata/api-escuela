<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
 
class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return response()->json($cursos);
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nombre_curso' => 'required',
            'descripcion' => 'required',
            'creditos' => 'required|integer',
        ]);
 
        $curso = Curso::create([
            'nombre_curso' => $request->nombre_curso,
            'descripcion' => $request->descripcion,
            'creditos' => $request->creditos,
        ]);
 
        return response()->json([
            'mensaje' => 'Curso guardado correctamente',
            'curso' => $curso
        ], 201);
    }
 
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->update($request->all());
        return response()->json([
            'mensaje' => 'Curso actualizado',
            'curso' => $curso
        ]);
    }
 
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return response()->json(['mensaje' => 'Curso eliminado']);
    }
}