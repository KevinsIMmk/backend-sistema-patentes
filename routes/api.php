<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\PatenteController;
use App\Http\Controllers\InspeccionesController;
use App\Http\Controllers\EstadoInspeccionController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\TipoPatenteController;
use App\Http\Controllers\ObservacionesController;
use App\Http\Controllers\PagoPatenteController;
use App\Http\Controllers\EstadoPatenteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// PATENTES
// ============================================================

// Listar patentes
Route::get('/patentes', [PatenteController::class, 'index']);

// Crear nueva patente
Route::post('/patentes', [PatenteController::class, 'store']);

// Editar datos de patente
Route::put('/patentes/{id}/editar', [PatenteController::class, 'updateDatos']);

// Patente por ID (datos base)
Route::get('/patentes/{id}', [PatenteController::class, 'show']);

// 🔥 Patente completa (para PDF, inspecciones + observaciones)
Route::get('/patentes/{id}/full', [PatenteController::class, 'showFull']);

// Buscar patente por número
Route::get('/patentes/numero/{numero_patente}', [PatenteController::class, 'showByNumero']);

// Actualizar estado
Route::put('/patentes/{id}/estado', [PatenteController::class, 'updateEstado']);

// Listar tipos de estado
Route::get('/estados_patente', [PatenteController::class, 'indexEstados']);

Route::get('/tipos_patente', [TipoPatenteController::class, 'index']);

// ============================================================
// CONTRIBUYENTES
// ============================================================
Route::get('/contribuyentes', [ContribuyenteController::class, 'index']); // Listar todos
Route::get('/contribuyentes/{id}', [ContribuyenteController::class, 'show']); // Mostrar uno
Route::post('/contribuyentes', [ContribuyenteController::class, 'store']); // Crear
Route::put('/contribuyentes/{id}', [ContribuyenteController::class, 'update']); // Actualizar
Route::delete('/contribuyentes/{id}', [ContribuyenteController::class, 'destroy']); // Eliminar
Route::get('/estados_patente', [EstadoPatenteController::class, 'index']);

Route::put('/patentes/{id}/editar', [PatenteController::class, 'updateDatos']);


// ============================================================
// INSPECCIONES
// ============================================================

// Listar inspecciones
Route::get('/inspecciones', [InspeccionesController::class, 'index']);

// Crear inspección
Route::post('/inspecciones', [InspeccionesController::class, 'store']);

Route::put('/inspecciones/{id}', [InspeccionesController::class, 'update']);


// ============================================================
// ESTADOS Y TIPOS
// ============================================================

Route::get('/estados_inspeccion', [EstadoInspeccionController::class, 'index']);
Route::get('/tipos_documento', [TipoDocumentoController::class, 'index']);


// ============================================================
// OBSERVACIONES
// ============================================================

Route::get('/observaciones', [ObservacionesController::class, 'index']);
// Listar observaciones de una inspección
Route::get('/inspecciones/{id}/observaciones',
    [ObservacionesController::class, 'index']);

// Agregar nueva observación
Route::post('/inspecciones/{id}/observaciones',
    [ObservacionesController::class, 'store']);


// ============================================================
// PAGOS – BUSCAR PATENTE (RUT O NÚMERO)
// ============================================================

Route::get('/buscar_patente', [PagoPatenteController::class, 'buscar']);


// ============================================================
// AUTH (opcional)
// ============================================================

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
