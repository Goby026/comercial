<?php

namespace appComercial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Utilidad extends Model
{
    protected $table = 'tutilidad';
    protected $primaryKey = 'codiUtilidad';
//    public $incrementing = false;//importante cuando la llave primaria es un varchar
    public $timestamps = false;

    protected $fillable = [
        'cantCoti',
        'cantFactu',
        'montoFactu',
        'costoSinIgv',
        'margen',
        'utilidad',
        'codiCola',
        'estado'
    ];

    protected $guarded = [
    ];

    public function getUtilidades($fechaIni, $fechaFin)
    {
        $utilidades = DB::select("select c.codiCola, col.nombreCola, count(c.codiCoti) as cotizaciones,
(select count(codiCotiFinal)
	from tcotizacionfinal
    where codiCola = c.codiCola and fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "') as facturado,
(select round(sum(montoTotalFactuSIGV),2)
	from tcotizacionfinal
    where codiCola = c.codiCola and fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "') as montoFacturado,
(select round(sum(montoTotalCotiFinalSIGV),2)
	from tcotizacionfinal 
    where codiCola = c.codiCola and fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "') as costoSIGV,
(select round(sum(utilidadFinal),2)
	from tcotizacionfinal 
    where codiCola = c.codiCola and fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "') as utilidad,
(select round(avg(margenFinal),2)
	from tcotizacionfinal 
    where codiCola = c.codiCola and fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "') as margen
from tcotizacion c
inner join tcolaborador col on col.codiCola = c.codiCola
where c.fechaSistema between '" . $fechaIni . "' and '" . $fechaFin . "'
group by c.codiCola
order by col.nombreCola");

        return $utilidades;
    }
}
