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
		'codiDolar'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
