<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'tcontrato';
    protected $primaryKey = 'codiContrato';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiArea',
        'codiCargo',
        'codiCola',
        'codiEmpre',
        'codiTipoContra',
        'estaContra',
        'fechaIniContra',
        'fechaFinaContra',
        'fechaFinaExpoContra',
        'motiFinaContra'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
