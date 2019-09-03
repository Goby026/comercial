<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'tcolaborador';
    protected $primaryKey = 'codiCola';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'apePaterCola',
		'apeMaterCola',
		'nombreCola',
		'dniCola',
		'fechaNaciCola',
		'correoCorpoCola',
        'correoProveedora',
        'correoAnie',
		'correoPersoCola',
		'celuCorpoCola',
		'celuPersoCola',
		'codiDepar',
		'codiProvin',
		'codiDistri',
		'direcCola',
		'fotoCola',
		'fechaRegisCola',
		'contraCola',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
