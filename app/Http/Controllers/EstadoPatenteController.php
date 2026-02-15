<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstadoPatente;
use Illuminate\Http\Request;

class EstadoPatenteController extends Controller
{
    // Listar todos los estados
    public function index()
    {
        $estados = EstadoPatente::all();
        return response()->json($estados);
    }

    // Mostrar un estado específico
    public function show($id)
    {
        $estado = EstadoPatente::findOrFail($id);
        return response()->json($estado);
    }

    // Crear un nuevo estado
    public function store(Request $request)
    {
        $data = $request->validate([
            'estado' => 'required|string|max:255',
        ]);

        $estado = EstadoPatente::create($data);
        return response()->json($estado, 201);
    }

    // Actualizar un estado existente
    public function update(Request $request, $id)
    {
        $estado = EstadoPatente::findOrFail($id);

        $data = $request->validate([
            'estado' => 'sometimes|required|string|max:255',
        ]);

        $estado->update($data);
        return response()->json($estado);
    }

    // Eliminar un estado
    public function destroy($id)
    {
        $estado = EstadoPatente::findOrFail($id);
        $estado->delete();
        return response()->json(['message' => 'Estado de patente eliminado correctamente']);
    }
}
