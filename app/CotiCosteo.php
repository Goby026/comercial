<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CotiCosteo extends Model
{
    protected $table = 'tcoticosteo';
    protected $primaryKey = 'idTCotiCosteo';
    // public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'codiCosteo',
		'codiCoti',
		'codiCola',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
