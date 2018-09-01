<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class TipoProveedor extends Model
{
    protected $table = 'ttipoproveedor';
    protected $primaryKey = 'codiTipoProveedor';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'nombreTipoProveedor',
        'nombreBreveTipoProveedor',
        'estaTipoProveedor'
    ];

    protected $guarded = [
    ];
}
