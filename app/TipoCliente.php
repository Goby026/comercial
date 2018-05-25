<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $table = 'ttipocliente';
    protected $primaryKey = 'codiTipoCliente';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreTipoCliente',
    	'nombreBreveTipoCliente',
        'entidad',
        'estaTipoCliente'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
