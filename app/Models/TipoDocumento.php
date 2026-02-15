<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model{
    protected $table = 'tipo_documento'; 
    protected $primaryKey = 'idtipo_documento';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipo_documento',
    ];

    protected $guarded = [
        'idtipo_documento',
    ];
}













/* Table: tipo_documento
Columns:
idtipo_documento int AI PK 
tipo_documento varchar(255) */
