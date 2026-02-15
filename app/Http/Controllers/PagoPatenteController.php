<?php

namespace App\Http\Controllers;

use App\Models\PagoPatente;
use App\Models\Patente; // Necesario para la función buscar
use Illuminate\Http\Request;

class PagoPatenteController extends Controller
{
    /**
     * 📌 Mostrar todos los pagos de patente (API Index)
     */
    public function index()
    {
        // Traemos todos los registros con las relaciones
        $pagos = PagoPatente::with(['patente', 'estadoPago'])->get();

        return response()->json([
            'success' => true,
            'data' => $pagos
        ]);
    }

    /**
     * 📌 Muestra un pago de patente específico
     */
    public function show($id)
    {
        $pago = PagoPatente::with(['patente', 'estadoPago'])->find($id);

        if (!$pago) {
            return response()->json([
                'success' => false,
                'message' => 'Pago de patente no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pago
        ]);
    }

    /**
     * 📌 Almacena un nuevo pago de patente (API Store)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'monto_total' => 'required|numeric',
            'monto_pagado' => 'required|numeric',
            'semestre' => 'required|string|max:45',
            'fecha_vencimiento' => 'required|date',
            // La regla 'exists' asegura que la patente y el estado existan
            'patente_idPatente' => 'required|integer|exists:patente,idPatente',
            'estado_pago_idestado_pago' => 'required|integer|exists:estado_pago,idestado_pago',
        ]);

        $pago = PagoPatente::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pago de patente creado correctamente',
            'data' => $pago
        ], 201);
    }

    /**
     * 📌 Busca una patente por número y/o RUT (API Buscar)
     * (Asumo que esta lógica usa el modelo Patente de Laravel, no el de PagoPatente)
     */
    public function buscar(Request $request)
    {
        $numeroPatente = $request->query('numero');
        $rut = $request->query('rut');

        // Se usa el modelo Patente
        $query = Patente::with('contribuyente');

        if ($numeroPatente) {
            // CORRECCIÓN PARA MAYÚSCULAS/MINÚSCULAS:
            // Usamos whereRaw con UPPER() para que la búsqueda sea insensible a mayúsculas.
            $query->whereRaw('UPPER(numero_patente) = ?', [strtoupper($numeroPatente)]);
        }

        if ($rut) {
            $query->whereHas('contribuyente', function ($q) use ($rut) {
                // Limpieza del RUT para buscar solo dígitos y la K/k
                $cleanRut = preg_replace('/[^0-9Kk]/', '', $rut);
                $q->where('rut', $cleanRut);
            });
        }

        $patente = $query->first();

        if (!$patente) {
            return response()->json([
                'success' => false,
                'message' => 'Patente no encontrada con los datos proporcionados.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $patente
        ]);
    }
}