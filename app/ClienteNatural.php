<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ClienteNatural extends Model
{
    protected $table = 'tclientenatural';
    protected $primaryKey = 'codiClienNatu';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'apePaterClienN',
		'apeMaterClienN',
		'nombreClienNatu',
		'dniClienNatu',
		'direcClienNatu',
		'codiDistri',
		'codiProvin',
		'codiDepar',
		'fechaNaciClienN',
		'correoClienNatu',
		'tele01ClienNatu',
		'tele02ClienNatu',
		'fechaRegisClien',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
