<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Igv extends Model
{
    protected $table = 'tigv';
    protected $primaryKey = 'codiIgv';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiCola',
		'valorIgv',
		'fechaInIgv',
		'fechaFinalIgv',
		'estaIgv'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
