<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Costeo extends Model
{
    protected $table = 'tcosteo';
    protected $primaryKey = 'codiCosteo';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'fechaIniCosteo',
		'fechaFinCosteo',
		'costoTotalDolares',
		'costoTotalSoles',
		'totalVentaSoles',
		'utilidadVentaSoles',
		'margenCosto',
		'margenVenta',
		'codiCosteoEsta',
		'codiCola',
		'codiIgv',
		'codiDolar',
        'tipoCosteo',//para saber si es de tipo producto o servicio
        'currency', //0 = soles, 1=dolares
        'mostrarTotal',
        'cantiPc',
        'totalPartes',
        'utiPartes',
        'margenPartes',
        'detalle',
        'imagen'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
