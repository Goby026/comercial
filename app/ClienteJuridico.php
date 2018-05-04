<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ClienteJuridico extends Model
{
    protected $table = 'tclientejuridico';
    protected $primaryKey = 'codiClienJuri';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'razonSocialClienJ',
		'rucClienJuri',
		'direcClienJuri',
		'codiDistri',
		'codiProvin',
		'codiDepar',
		'codiTipoCliJur',
		'webClienJuri',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
