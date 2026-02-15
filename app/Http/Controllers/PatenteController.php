<?php

namespace App\Http\Controllers;

use App\Models\Patente;
use Illuminate\Http\Request;

class PatenteController extends Controller
{
    /**
     * 📌 Listar todas las patentes con relaciones
     */
    public function index()
    {
        $patentes = Patente::with(['contribuyente', 'tipoPatente', 'estadoPatente'])->get();

        return response()->json([
            'success' => true,
            'data' => $patentes
        ]);
    }

    /**
     * 🆕 Crear una nueva patente
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_patente' => 'required|string|unique:patente,numero_patente',

            'contribuyente_idcontribuyente' => 'required|exists:contribuyente,idcontribuyente',
            'tipo_patente_idtipo_patente'   => 'required|exists:tipo_patente,idtipo_patente',
            'estado_patente_idestado_patente' => 'required|exists:estado_patente,idestado_patente',

            'direccion_comercial' => 'nullable|string|max:255',
            'actividad_patente'   => 'nullable|string|max:255',
        ]);

        $patente = Patente::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Patente creada correctamente',
            'data' => $patente
        ], 201); 
    }

    /**
     * 📌 Mostrar una patente específica
     */
    public function show($id)
    {
        $patente = Patente::with(['contribuyente', 'tipoPatente', 'estadoPatente'])->find($id);

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $patente
        ]);
    }

    /**
     * 🔎 Buscar por número de patente
     */
    public function showByNumero($numero_patente)
    {
        $patente = Patente::with(['contribuyente', 'tipoPatente', 'estadoPatente'])
            ->where('numero_patente', $numero_patente)
            ->first();

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $patente
        ]);
    }

    /**
     * 🟡 Actualizar solo el estado
     */
    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado_patente_idestado_patente' =>
                'required|integer|exists:estado_patente,idestado_patente',
        ]);

        $patente = Patente::find($id);

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada'
            ], 404);
        }

        $patente->estado_patente_idestado_patente =
            $request->estado_patente_idestado_patente;

        $patente->save();

        $patente->load(['estadoPatente']);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'data' => $patente
        ]);
    }

    /**
     * 📌 Listar estados disponibles
     */
    public function indexEstados()
    {
        $estados = \DB::table('estado_patente')->get();

        return response()->json([
            'success' => true,
            'data' => $estados
        ]);
    }

    /**
     * 🧾 Patente + inspecciones + observaciones
     */
    public function showFull($id)
    {
        $patente = Patente::with([
            'contribuyente',
            'tipoPatente',
            'estadoPatente',
            'inspecciones.tipoDocumento',
            'inspecciones.observaciones'
        ])->find($id);

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $patente
        ]);
    }

    /**
     * ✏️ Editar datos de la patente
     */
    public function updateDatos(Request $request, $id)
    {
        $request->validate([
            'direccion_comercial' => 'required|string|max:255',
            'actividad_patente' => 'required|string|max:255',

            'contribuyente_idcontribuyente' =>
                'required|integer|exists:contribuyente,idcontribuyente',

            'tipo_patente_idtipo_patente' =>
                'required|integer|exists:tipo_patente,idtipo_patente',

            'estado_patente_idestado_patente' =>
                'required|integer|exists:estado_patente,idestado_patente',
        ]);

        $patente = Patente::find($id);

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada'
            ], 404);
        }

        $patente->update([
            'direccion_comercial' => $request->direccion_comercial,
            'actividad_patente' => $request->actividad_patente,
            'contribuyente_idcontribuyente' => $request->contribuyente_idcontribuyente,
            'tipo_patente_idtipo_patente' => $request->tipo_patente_idtipo_patente,
            'estado_patente_idestado_patente' => $request->estado_patente_idestado_patente,
        ]);

        // Recargar relaciones
        $patente->load(['contribuyente', 'tipoPatente', 'estadoPatente']);

        return response()->json([
            'success' => true,
            'message' => 'Patente actualizada correctamente',
            'data' => $patente
        ]);
    }
}
