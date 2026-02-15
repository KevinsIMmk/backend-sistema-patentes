<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagoPatente extends Model
{
    // --- Configuración del Modelo ---
    protected $table = 'pago_patente';
    protected $primaryKey = 'idpago_patente';
    public $timestamps = false;
    public $incrementing = true;

    // --- Atributos que pueden ser asignados masivamente ---
    protected $fillable = [
        'monto_pagado',
        'semestre',
        'patente_idPatente',         // Clave foránea a la tabla 'patente'
        'estado_pago_idestado_pago', // Clave foránea a la tabla 'estado_pago'
    ];

    protected $guarded = [
        'idpago_patente',
    ];



    public function patente(): BelongsTo
    {
        return $this->belongsTo(Patente::class, 'patente_idPatente', 'idPatente');
    }

    
    public function estadoPago(): BelongsTo
    {
        return $this->belongsTo(EstadoPago::class, 'estado_pago_idestado_pago', 'idestado_pago');
    }
}