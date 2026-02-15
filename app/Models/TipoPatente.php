<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPatente extends Model
{
    protected $table = 'tipo_patente'; 
    protected $primaryKey = 'idtipo_patente';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipo_patente',
    ];

    protected $guarded = [
        'idtipo_patente',
    ];
}
