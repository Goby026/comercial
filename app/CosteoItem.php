<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CosteoItem extends Model
{
    protected $table = 'tcosteoitem';
    protected $primaryKey = 'idCosteoItem';
    //public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiCosteo',
		'itemCosteo',
		'fechaCosteoIni',
		'codiProveedor',
		'codiProducProveedor',
		'cantiCoti',
		'precioProducDolar',
		'costoUniIgv',
		'costoTotalIgv',
		'costoUniSolesIgv',
		'costoTotalSolesIgv',
		'margenCoti',
		'utiCoti',
		'margenVentaCoti',
		'fechaCosteoActu',
		'numPack',
		'codiProveeContac',
		'estado',
		'fechaSistema'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
