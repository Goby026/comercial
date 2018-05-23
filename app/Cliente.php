<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'tcliente';
    protected $primaryKey = 'codiClien';
    public $incrementing = false;//activar cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiTipoCliente',
		'codiClienJuri',
		'codiClienNatu',
		'codiCola',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
