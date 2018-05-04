<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ProductoProveedor extends Model
{
    protected $table = 'tproductoproveedor';
    protected $primaryKey = 'codiProducProveedor';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiMarca',
		'nombreProducProveedor',
		'nombreBreveProducP',
		'codiProducMarca',
		'codInterno',
		'descripProduc',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [

    ];
}
