<?php

namespace appComercial\Http\Controllers;

use appComercial\Cotizacion;
use appComercial\User;
use Illuminate\Http\Request;

use appComercial\Http\Requests;
use Illuminate\Support\Facades\DB;

class UtilidadController extends Controller
{
    public function index(){

        $usuarios = User::all();

        return view('utilidades.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function getUtilidades(Request $request){
//        $fechaIni = date("Y-m-d", strtotime($request->get('txtFechaInicio')));
//        $fechaFin = date("Y-m-d", strtotime($request->get('txtFechaFinal')));
        $fechaIni = $request->get('txtFechaInicio');
        $fechaFin = $request->get('txtFechaFinal');
        $codiCola = $request->get('txtCola');

        $usuarios = User::all();

        $utilidades = DB::table('tcotizacionfinal as cf')
            ->join('tcolaborador as col', 'col.codiCola', '=', 'cf.codiCola')
            ->join('tcotizacion as c', 'c.codiCoti', '=', 'cf.codiCoti')
            ->select('cf.codiCola','col.nombreCola',DB::raw('count(c.codiCoti) as Cotizaciones') ,DB::raw('count(cf.codiCotiFinal) as Cerradas'), DB::raw('(SELECT SUM(totalVentaSoles) FROM tcosteo WHERE codiCola = ' . $codiCola . ') as MontoVenta'), DB::raw('(SELECT SUM(costoTotalSoles) FROM tcosteo WHERE codiCola = ' . $codiCola . ') as Costo'), DB::raw('(SELECT AVG(margenCosto) FROM tcosteo WHERE codiCola = ' . $codiCola . ') as Margen'), DB::raw('(SELECT SUM(utilidadVentaSoles) FROM tcosteo WHERE codiCola = ' . $codiCola . ') as Utilidad'), 'c.codiCola')
            ->where('col.codiCola', '=', $codiCola)
            ->get();

//        $colaboradores = Colaborador::all();
//        $tipoGastos = TipoGasto::all();

        return view('utilidades.index', [
            'utilidades' => $utilidades,
            'usuarios' => $usuarios
        ]);

    }

}
