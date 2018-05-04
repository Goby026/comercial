<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class MarcaProducto extends Model
{
    protected $table = 'tmarcaproducto';
    protected $primaryKey = 'codiMarca';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreMarca',
		'nombreBreveMarca',
		'imagenMarca',
		'estaMarca'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
