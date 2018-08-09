<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CotiCondiciones extends Model
{
    protected $table = 'tcoticondiciones';
    protected $primaryKey = 'idTCotiCondiciones';
    // public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiCondiComer',
        'codiCoti',
        'descripcion',
        'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
