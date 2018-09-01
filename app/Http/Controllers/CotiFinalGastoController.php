<?php

namespace appComercial\Http\Controllers;

use appComercial\CategoriaGasto;
use appComercial\CotiFinalGasto;
use appComercial\CotizacionFinal;
use appComercial\TipoComproPago;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CotiFinalGastoController extends Controller
{
    public function store(Request $request){
        $categoriaGasto = CategoriaGasto::all();
        $tipoComproPago = TipoComproPago::all();
        $cotiFinal = DB::table('tcotizacionfinal as cf')
            ->join('ttipocompropago as tcp','cf.codiTipoComproPago','=','tcp.codiTipoComproPago')
            ->select('cf.codiCotiFinal','cf.numeComproPago','cf.montoTotalFactuSIGV','tcp.nombreTipoComproPago')
            ->where('cf.codiCotiFinal','=',$request->get('txtCodiCotiFinal'))->first();

        $cotiFinalGasto = new CotiFinalGasto();
        $cotiFinalGasto->codiTipoGasto = $request->get('txtTipoGasto');
        $cotiFinalGasto->codiCotiFinal = $request->get('txtCodiCotiFinal');
        $cotiFinalGasto->fechaGasto = $request->get('txtFecha');
        $cotiFinalGasto->codiCola = $request->get('txtColaGasto');
        $cotiFinalGasto->totalGasto = $request->get('txtMonto');
        $cotiFinalGasto->estaGasto = $request->get('txtEstadoGasto');

//        if ($cotiFinalGasto->save()){
        if ($cotiFinalGasto->totalGasto > 0){
            return view('cierres.gastos', [
                'cotiFinal' => $cotiFinal,
                'categoriaGasto' => $categoriaGasto,
                'tipoComproPago' => $tipoComproPago,
                'cotiFinalGasto' => $cotiFinalGasto
            ]);
        }else{
            return "Error";
        }
    }
}
