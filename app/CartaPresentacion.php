<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CartaPresentacion extends Model
{
    protected $table = 'tcartapresentacion';
    protected $primaryKey = 'codiCartaPresen';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;
    
    protected $fillable = [
    	'codiTipoCartaPresen',
		'conteCartaPresen',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
