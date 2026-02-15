<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contribuyente;
use Illuminate\Http\Request;

class ContribuyenteController extends Controller
{
	// Listar todos los contribuyentes
	public function index()
	{
		$contribuyentes = Contribuyente::all();
		return response()->json($contribuyentes);
	}

	// Mostrar un contribuyente específico
	public function show($id)
	{
		$contribuyente = Contribuyente::findOrFail($id);
		return response()->json($contribuyente);
	}

	// Crear un nuevo contribuyente
	public function store(Request $request)
	{
		$data = $request->validate([
			'rut' => 'required|string|max:255',
			'razon_social' => 'required|string|max:255',
			'representante_legal' => 'nullable|string|max:255',
			'direccion' => 'nullable|string|max:255',
			'poblacion' => 'nullable|string|max:255',
			'contacto' => 'nullable|string|max:255',
		]);

		$contribuyente = Contribuyente::create($data);
		return response()->json($contribuyente, 201);
	}

	// Actualizar un contribuyente existente
	public function update(Request $request, $id)
	{
		$contribuyente = Contribuyente::findOrFail($id);

		$data = $request->validate([
			'rut' => 'sometimes|required|string|max:255',
			'razon_social' => 'sometimes|required|string|max:255',
			'representante_legal' => 'sometimes|nullable|string|max:255',
			'direccion' => 'sometimes|nullable|string|max:255',
			'poblacion' => 'sometimes|nullable|string|max:255',
			'contacto' => 'sometimes|nullable|string|max:255',
		]);

		$contribuyente->update($data);
		return response()->json($contribuyente); 
	}

	// Eliminar un contribuyente
	public function destroy($id)
	{
		$contribuyente = Contribuyente::findOrFail($id);
		$contribuyente->delete();
		return response()->json(['message' => 'Contribuyente eliminado correctamente']);
	}
}