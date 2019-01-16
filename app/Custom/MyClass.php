<?php 
/**
* 
*/
namespace appComercial\Custom;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MyClass
{
	
	public function __construct(){

    }

	public function pk_generator($iniciales){
        $pk = "";
        $hoy = getdate();
        $pk .= $iniciales."_".$hoy['mday']."_".$hoy['mon']."_".$hoy['year'];
        // print_r($hoy);

        $rand = range(1, 13);
        shuffle($rand);
        foreach ($rand as $val) {
            $pk .= $val;
        }

        return $pk;
    }

    public function getNumeracion()
    {
        $myTime = Carbon::now('America/Lima');
        $year = $myTime->format('Y');
//	    funcionalidad solo para 2019 - ya que se implemento la numeracion automática despues de la cotizacion #25
        //empezar desde 0

        if ($year == '2019') {
            $opc = DB::select("select count(*) as num from tcotizacion where fechaCoti > '2019-01-06 23:59:00'");

            if ($opc[0]->num > 0) {
                $numCotis = $opc;
            } else {
                $numCotis = DB::select("select count(*) as num from tcotizacion where year(fechaCoti) = '" . $year . "' ");
            }
        } else {
            $numCotis = DB::select("select count(*) as num from tcotizacion where year(fechaCoti) = '" . $year . "' ");
        }

        $numeracion = $numCotis[0]->num;

        return $numeracion + 1;
    }

}