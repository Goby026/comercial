<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CosteoEstado extends Model
{
    protected $table = 'tcosteoestado';
    protected $primaryKey = 'codiCosteoEsta';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'nombreCosteoEsta',
		'nombreBreveCosteoEsta',
		'ordenCosteoEsta',
		'estaCosteoEsta'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
