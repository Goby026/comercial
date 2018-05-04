<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'tproveedor';
    protected $primaryKey = 'codiProveedor';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreProveedor',
		'nombreBreveProveedor',
		'RucProveedor',
		'direcProveedor',
		'webProveedor',
		'estaProveedor',
		'codiDistri',
		'codiProvin',
		'codiDepar'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
