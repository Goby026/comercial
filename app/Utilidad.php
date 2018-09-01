<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Utilidad extends Model
{
    protected $table = 'tutilidad';
    protected $primaryKey = 'codiUtilidad';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'cantCoti',
        'cantFactu',
        'montoFactu',
        'costoSinIgv',
        'margen',
        'utilidad',
        'codiCola',
        'estado'
    ];

    protected $guarded = [
    ];
}
