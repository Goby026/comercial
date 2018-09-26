<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Mercaderia extends Model
{
    protected $table = 'tmercaderia';
    protected $primaryKey = 'codiMercaderia';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codIterno',
        'item',
        'codiProveedor',
        'numDocumento',
        'cantidad',
        'costoUniDolarSIN',
        'costoUniDolar',
        'totalDolar',
        'costoUniSoles',
        'totalSoles',
        'utilidad',
        'codiCotiFinal',
        'codiIgv',
        'codiDolar',
        'numPack'
    ];

    protected $guarded = [
    ];
}
