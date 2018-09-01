<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class DetalleGasto extends Model
{
    protected $table = 'tdetallegasto';
    protected $primaryKey = 'codidetagasto';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiCateGasto',
        'codiTipoComproPago',
        'numeComproPago',
        'montoDetaGasto',
        'fechaDetaGasto',
        'descripDetaGasto',
        'estaDetaGasto',
        'fechaRegisGasto',
        'origen',
        'destino',
        'tiempo_horas',
        'codiCotiFinalGasto',
        'codiProveedor'
    ];

    protected $guarded = [
    ];
}
