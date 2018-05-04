<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ProveedorContacto extends Model
{
    protected $table = 'tproveedorcontacto';
    protected $primaryKey = 'codiProveeContac';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'apePaterProveeC',
		'apeMaterProveeC',
		'nombreProveeContac',
		'dniProveeContac',
		'celu01ProveeContac',
		'celu02ProveeContac',
		'tele01ProveeContac',
		'anexoProveeContac',
		'correo01ProveeContac',
		'correo02ProveeContac',
		'skypeProveeContac',
		'codiProveedor',
		'codiMarca',
		'codiCargoContac',
		'detalle',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
