<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class TipoCartaPresen extends Model
{
    protected $table = 'ttipocartapresen';
    protected $primaryKey = 'codiTipoCartaPresen';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;
    
    protected $fillable = [
    	'tipoCartaPresen',
		'nombreTipoCartaP',
		'nombreBreveTipoCartaP',
		'estaTipoCartaPresen'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
