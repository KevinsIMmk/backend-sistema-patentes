<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPatente extends Model
{
    protected $table = 'estado_patente'; // ajustar si tu tabla se llama distinto (p.ej. 'estado_patentes')
    protected $primaryKey = 'idestado_patente';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'estado',
    ];

    protected $guarded = [
        'idestado_patente',
    ];
}
