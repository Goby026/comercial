<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ContactoCliente extends Model
{
    protected $table = 'tcontactocliente';
    protected $primaryKey = 'codiContacClien';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'apePaterContacC',
		'apeMaterContacC',
		'nombreContacClien',
		'correoContacClien',
		'direcContacClien',
		'codiDistri',
		'codiProvin',
		'codiDepar',
		'celu01ContacClien',
		'celu02ContacClien',
		'teleContacClien',
		'aneContacClien',
		'fechaRegisContacClien',
		'codiClienJuri',
		'codiCola',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
