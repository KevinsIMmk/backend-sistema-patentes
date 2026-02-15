<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoInspeccion extends Model
{
    protected $table = 'estado_inspeccion'; 
    protected $primaryKey = 'idestado_inspeccion';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'estado_inspeccion',
    ];

    protected $guarded = [
        'idestado_inspeccion',
    ];

}

/* <!-- Table: estado_inspeccion
Columns:
idestado_inspeccion int AI PK 
estado_inspeccion varchar(255) --> */