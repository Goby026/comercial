<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CotizacionEstado extends Model
{
    protected $table = 'tcotizacionestado';
    protected $primaryKey = 'codiCotiEsta';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreCotiEsta',
		'nombreBreveCotiEsta',
		'ordenCotiEsta',
		'estaCotiEsta'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
