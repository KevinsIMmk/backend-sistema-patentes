<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importamos BelongsTo

class Observaciones extends Model
{
    protected $table = 'observaciones';
    protected $primaryKey = 'idobservaciones';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = [
        'descripcion',
        'inspecciones_idinspecciones',
        
    ];

    protected $guarded = [
        // Corregido: 'idcontribuyente' probablemente no existe aquí. Si te referías a la clave primaria, es 'idobservaciones'.
        'idobservaciones', 
    ];

    // --- RELACIONES ELOQUENT ---

    /**
     * Define la relación con el modelo Inspeccion.
     * Una Observación pertenece a una Inspección.
     */
    public function inspeccion(): BelongsTo // El nombre de la función DEBE ser 'inspeccion' (singular)
    {
        
        return $this->belongsTo(Inspecciones::class, 'inspecciones_idinspecciones', 'idinspecciones');
    }

}
