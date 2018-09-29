<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class CotiFinalGasto extends Model
{
    protected $table = 'tcotifinalgasto';
    protected $primaryKey = 'codicotifinalgasto';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'codiTipoGasto',
        'codiCotiFinal',
        'fechaGasto',
        'codiCola',
        'totalGasto',
        'estaGasto',
        'num'
    ];

    protected $guarded = [
    ];
}
