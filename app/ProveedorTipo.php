<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ProveedorTipo extends Model
{
    protected $table = 'tproveedor_tipo';
    protected $primaryKey = 'codiProveeTipo';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiProveedor',
        'codiTipoProveedor'
    ];

    protected $guarded = [
    ];
}
