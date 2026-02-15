<?php

namespace App\Http\Controllers;

use App\Models\Inspecciones;
use Illuminate\Http\Request;

class InspeccionesController extends Controller
{
    /**
     * Crear una nueva inspección
     * 
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trimestre' => 'required|string|max:45',
            'fecha_inspeccion' => 'required|date',
            'idInspector' => 'nullable|integer',
            'inspector' => 'nullable|string|max:255',

            'patente_idPatente' => 'required|integer|exists:patente,idPatente',

            'estado_inspeccion_idestado_inspeccion'
                => 'required|integer|exists:estado_inspeccion,idestado_inspeccion',

            'tipo_documento_idtipo_documento'
                => 'required|integer|exists:tipo_documento,idtipo_documento',

            'motivo' => 'nullable|string|max:255',
        ]);

        $inspeccion = Inspecciones::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Inspección creada correctamente',
            'data' => $inspeccion
        ]);
    }


    /**
     * Listar inspecciones con todas las relaciones necesarias
     */
    public function index()
    {
        $inspecciones = Inspecciones::with([
            'patente',
            'estadoInspeccion',
            'tipoDocumento',
            'observaciones'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $inspecciones
        ]);
    }


    /**
     * Actualizar inspección (fecha / estado / tipo documento / motivo)
     */
    public function update(Request $request, $id)
    {
        $inspeccion = Inspecciones::with('estadoInspeccion')->findOrFail($id);

        // 🚫 Bloquear si está finalizada
        if ($inspeccion->estadoInspeccion->estado_inspeccion === 'Finalizada') {
            return response()->json([
                'success' => false,
                'message' => 'La inspección está finalizada y no puede ser modificada.'
            ], 403);
        }

        $validated = $request->validate([
            'fecha_inspeccion' => 'sometimes|date',
            'estado_inspeccion_idestado_inspeccion'
                => 'sometimes|integer|exists:estado_inspeccion,idestado_inspeccion',
            'tipo_documento_idtipo_documento'
                => 'sometimes|integer|exists:tipo_documento,idtipo_documento',
            'motivo' => 'nullable|string|max:255',
        ]);

        $inspeccion->update($validated);

        $inspeccion->load([
            'estadoInspeccion',
            'tipoDocumento',
            'patente',
            'observaciones'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Inspección actualizada correctamente',
            'data' => $inspeccion
        ]);
    }
}