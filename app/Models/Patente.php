<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patente extends Model
{
    protected $table = 'patente';
    protected $primaryKey = 'idPatente';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'numero_patente',
        'direccion_comercial',
        'actividad_patente',
        'tipo_patente_idtipo_patente',
        'contribuyente_idcontribuyente',
        'estado_patente_idestado_patente'
    ];

    protected $keyType = 'int';

    protected $casts = [
        'idPatente' => 'integer',
        'tipo_patente_idtipo_patente' => 'integer',
        'contribuyente_idcontribuyente' => 'integer',
        'estado_patente_idestado_patente' => 'integer'
    ];

    // Relaciones
    public function contribuyente()
    {
        return $this->belongsTo(Contribuyente::class, 'contribuyente_idcontribuyente', 'idcontribuyente');
    }

    public function tipoPatente()
    {
        return $this->belongsTo(TipoPatente::class, 'tipo_patente_idtipo_patente', 'idtipo_patente');
    }

    public function estadoPatente()
    {
        return $this->belongsTo(EstadoPatente::class, 'estado_patente_idestado_patente', 'idestado_patente');
    }

    public function inspecciones()
    {
        return $this->hasMany(Inspecciones::class, 'patente_idPatente', 'idPatente');
    }
}


