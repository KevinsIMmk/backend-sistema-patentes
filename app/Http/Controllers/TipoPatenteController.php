<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoPatente;
use Illuminate\Http\Request;

class TipoPatenteController extends Controller
{
    // Listar todos los tipos de patente
    public function index()
    {
        $tipos = TipoPatente::all();
        return response()->json($tipos);
    }

    // Mostrar un tipo de patente específico
    public function show($id)
    {
        $tipo = TipoPatente::findOrFail($id);
        return response()->json($tipo);
    }

    // Crear un nuevo tipo de patente
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo_patente' => 'required|string|max:255',
        ]);

        $tipo = TipoPatente::create($data);
        return response()->json($tipo, 201);
    }

    // Actualizar un tipo de patente existente
    public function update(Request $request, $id)
    {
        $tipo = TipoPatente::findOrFail($id);

        $data = $request->validate([
            'tipo_patente' => 'sometimes|required|string|max:255',
        ]);

        $tipo->update($data);
        return response()->json($tipo);
    }

    // Eliminar un tipo de patente
    public function destroy($id)
    {
        $tipo = TipoPatente::findOrFail($id);
        $tipo->delete();
        return response()->json(['message' => 'Tipo de patente eliminado correctamente']);
    }
}
