<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ProdCarta extends Model
{
    protected $table = 'tprodcarta';
    protected $primaryKey = 'idtProdCarta';
    // public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'descripcion',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
