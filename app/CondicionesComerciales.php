<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CondicionesComerciales extends Model
{
    protected $table = 'tcondicionescomerciales';
    protected $primaryKey = 'codiCondiComer';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;
    
    protected $fillable = [
    	'descripCondiComer',
		'defecCondiComer',
		'orden',
        'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
