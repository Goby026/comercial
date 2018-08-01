<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
	protected $table = 'tcotizacion';
    protected $primaryKey = 'codiCoti';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'fechaCoti',
		'codiCosteo',
		'asuntoCoti',
        'nomCli',
		'codiClien',
        'codiContacClien',
		'codiTipoCliente',
		'codiCola',
		'tiemCoti',
		'codiCotiEsta',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
