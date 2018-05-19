<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class PrecioProductoProveedor extends Model
{
    protected $table = 'tprecioproductoproveedor';
    protected $primaryKey = 'idTPrecioProductoProveedor';
    //public $incrementing = false;//activar cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiCola',
		'codiProducProveedor',
		'codiProveedor',
		'precioProducDolar',
		'stockProduc',
		'tiempoEntreProduc',
		'fechaConsulProduc',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
