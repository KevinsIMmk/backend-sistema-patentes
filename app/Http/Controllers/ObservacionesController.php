<?php

namespace App\Http\Controllers;

use App\Models\Observaciones;
use App\Models\Inspecciones;
use Illuminate\Http\Request;

class ObservacionesController extends Controller
{
    public function store(Request $request, $idInspeccion)
    {
        // Validar que exista la inspección
        $inspeccion = Inspecciones::findOrFail($idInspeccion);

        $validated = $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $observacion = Observaciones::create([
            'descripcion' => $validated['descripcion'],
            'inspecciones_idinspecciones' => $inspeccion->idinspecciones
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Observación registrada correctamente',
            'data' => $observacion
        ]);
    }

    public function index($idInspeccion)
    {
        $observaciones = Observaciones::where(
            'inspecciones_idinspecciones',
            $idInspeccion
        )->get();

        return response()->json([
            'success' => true,
            'data' => $observaciones
        ]);
    }
}
