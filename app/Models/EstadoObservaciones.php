<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoObservaciones extends Model
{
    protected $table = 'estado_observaciones'; 
    protected $primaryKey = 'idestado_observaciones';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'estado_observaciones',
    ];

    protected $guarded = [
        'idestado_observaciones',
    ];

}

/* <!-- Table: estado_observaciones
Columns:
idestado_observaciones int AI PK 
estado_observaciones varchar(255) --> */