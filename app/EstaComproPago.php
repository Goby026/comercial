<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class EstaComproPago extends Model
{
    protected $table = 'testacompropago';
    protected $primaryKey = 'codiEstaComproPago';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    //en este modelo se registra los usuarios que configuran determinado precio de dolar segun el proveedor de dolar de la tabla tdolarproveedor
    protected $fillable = [
        'nombreEstaPago',
        'nombreBreveEstaPago',
        'estaEstaPago'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
