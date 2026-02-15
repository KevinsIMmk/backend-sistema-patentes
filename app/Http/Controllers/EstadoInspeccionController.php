<?php

namespace App\Http\Controllers;

use App\Models\EstadoInspeccion;
use Illuminate\Http\Request;

class EstadoInspeccionController extends Controller
{
    public function index()
    {
        $estados = EstadoInspeccion::all();

        return response()->json([
            'success' => true,
            'data' => $estados
        ]);
    }
}
