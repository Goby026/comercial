<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;

class ServCarta extends Model
{
    protected $table = 'tservcarta';
    protected $primaryKey = 'idtServCarta';
    // public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
    	'descripcion',
		'estado'
    ];

    //los campos guarded se especifican cuando no queremos q se asignen al modelo
    protected $guarded = [
    ];
}
