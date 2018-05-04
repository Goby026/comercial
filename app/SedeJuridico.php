<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class SedeJuridico extends Model
{
    protected $table = 'tsedejuridico';
    protected $primaryKey = 'codiSedeJur';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'descSedeJur',
		'estadoSedeJur',
		'fechaSistema',
		'codiClienJuri'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
