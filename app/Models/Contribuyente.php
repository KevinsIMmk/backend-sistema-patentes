<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
	protected $table = 'contribuyente';
	protected $primaryKey = 'idcontribuyente';
	public $incrementing = true;
	protected $keyType = 'int';
	public $timestamps = false;

	protected $fillable = [
		'rut',
		'razon_social',
		'representante_legal',
		'direccion',
		'poblacion',
		'contacto',
	];

	protected $guarded = [
		'idcontribuyente',
	];
}