<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class PartePc extends Model
{
    protected $table = 'tpartepc';
    protected $primaryKey = 'codiParte';
    // public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
        'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
