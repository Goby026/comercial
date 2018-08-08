<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'tcargo';
    protected $primaryKey = 'codiCargo';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiArea',
        'nombreCargo',
        'nombreBreveCargo',
        'estaCargo',
        'fechaRegisCargo',
        'fechaActiCargo',
        'fechaDesacCargo'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
