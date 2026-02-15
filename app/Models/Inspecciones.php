<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspecciones extends Model
{
    protected $table = 'inspecciones';
    protected $primaryKey = 'idinspecciones';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'trimestre',
        'fecha_inspeccion',
        'inspector',
        'patente_idPatente',
        'estado_inspeccion_idestado_inspeccion',
        'idInspector',
        'tipo_documento_idtipo_documento',
        'motivo'
    ];

    protected $guarded = [
        'idinspecciones',
    ];

    public function patente()
    {
        return $this->belongsTo(Patente::class, 'patente_idPatente', 'idPatente');
    }
    public function estadoInspeccion()
    {
        return $this->belongsTo(EstadoInspeccion::class, 'estado_inspeccion_idestado_inspeccion', 'idestado_inspeccion');
    }
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_idtipo_documento', 'idtipo_documento');
    }    

    public function observaciones()
    {
        return $this->hasMany(Observaciones::class, 'inspecciones_idinspecciones', 'idinspecciones');
    }
}


