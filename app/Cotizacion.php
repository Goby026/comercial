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
        'referencia',
        'nomCli',
		'codiClien',
        'nomContac',
        'codiContacClien',
		'codiTipoCliente',
		'codiCola',
		'tiemCoti',
		'codiCotiEsta',
        'margen_condi',
        'margen_firma',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
