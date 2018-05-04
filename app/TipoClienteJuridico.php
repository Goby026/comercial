<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class TipoClienteJuridico extends Model
{
    protected $table = 'ttipoclientejuridico';
    protected $primaryKey = 'codiTipoCliJur';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'descTipoCliJur',
    	'estadoTipoCliJur'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
