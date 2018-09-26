<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class MercaFacturada extends Model
{
    protected $table = 'tmercafacturada';
    protected $primaryKey = 'codimercafact';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    //en este modelo se registra los usuarios que configuran determinado precio de dolar segun el proveedor de dolar de la tabla tdolarproveedor
    protected $fillable = [
        'cantidad',
        'item',
        'codInterno',
        'codiProveedor',
        'precioU',
        'precioT',
        'valorTotal',
        'igv',
        'dctos',
        'numPack',
        'codiTFacturapd'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
