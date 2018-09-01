<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CategoriaGasto extends Model
{
    protected $table = 'tcategoriagasto';
    protected $primaryKey = 'codiCateGasto';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'nombreCateGasto',
        'nombreBreveCateGasto',
        'estaCateGasto',
        'codiTipoGasto'
    ];

    protected $guarded = [
    ];
}
