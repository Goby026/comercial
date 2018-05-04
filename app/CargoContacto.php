<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CargoContacto extends Model
{
    protected $table = 'tcargocontacto';
    protected $primaryKey = 'codiCargoContac';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreCargoContac',
		'nombreBreveCargoContac',
		'estaCargoContac'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
