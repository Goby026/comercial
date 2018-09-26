<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'codiArea';
    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'nombreArea',
        'nombreBreveArea',
        'estaArea',
        'fechaRegisArea',
        'fechaActiArea',
        'fechaDesacArea'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
