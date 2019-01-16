<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ItemParte extends Model
{
    protected $table = 'itemparte';
    protected $primaryKey = 'idItemParte';
//    public $incrementing = false;//true cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiCosteo',
        'codiParte',
        'codiMarca',
        'descripcion',
        'margencus',
        'cantidad',
        'cudsin',
        'cud',
        'totald',
        'cus',
        'totals',
        'pus',
        'total',
        'utilidad',
        'margenfinal'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
