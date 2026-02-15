<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPago extends Model
{
    protected $table = 'estado_pago'; // Nombre de la tabla de catálogo
    protected $primaryKey = 'idestado_pago';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        // Asumiendo que la columna que guarda el nombre del estado se llama 'nombre_estado'
        'nombre_estado', 
    ];

    // Opcional: Define la relación inversa (Un Estado puede tener muchos Pagos)
    public function pagosPatente()
    {
        return $this->hasMany(PagoPatente::class, 'estado_pago_idestado_pago', 'idestado_pago');
    }
}