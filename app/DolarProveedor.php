<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class DolarProveedor extends Model
{
    protected $table = 'tdolarproveedor';
    protected $primaryKey = 'codiDolarProveedor';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    //este modelo hace referencia a los precios de dolar de los proveedores. Ejm: Bancos, financieras, entidades que manejan su propio tipo de cambio
    protected $fillable = [
    	'nombreDolarProveedor',
		'nombreBreveDolarProveedor',
		'estaDolarProveedor',
		'defectoDolarProveedor',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
