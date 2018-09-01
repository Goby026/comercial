<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CotizacionFinal extends Model
{
    protected $table = 'tcotizacionfinal';
    protected $primaryKey = 'codiCotiFinal';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiCoti',
        'codiCola',
        'codiCosteo',
        'fechaHoraIni',
        'fechaHoraFin',
        'codiTipoComproPago',
        'numeComproPago',
        'codiEstaComproPago',
        'montoTotalFactuSIGV',
        'utilidadFinal',
        'margenFinal',
        'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
