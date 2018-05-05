<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Dolar extends Model
{
    protected $table = 'tdolar';
    protected $primaryKey = 'codiDolar';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    //en este modelo se registra los usuarios que configuran determinado precio de dolar segun el proveedor de dolar de la tabla tdolarproveedor
    protected $fillable = [
    	'dolarCompra',
		'dolarVenta',
		'fechaCambio',
		'codiDolarProveedor',
		'codiCola',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
