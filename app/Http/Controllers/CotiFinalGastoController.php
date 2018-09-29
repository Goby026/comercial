<?php

namespace appComercial\Http\Controllers;

use appComercial\CategoriaGasto;
use appComercial\CotiFinalGasto;
use appComercial\Cotizacion;
use appComercial\CotizacionFinal;
use appComercial\TipoComproPago;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CotiFinalGastoController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
//            $cotisFinal = DB::table('tcotizacionfinal as cf')
//                ->join('tcotizacion as c', 'c.codiCoti', '=', 'cf.codiCoti')
//                ->join('tcotizacionestado as ce', 'ce.codiCotiEsta', '=', 'c.codiCotiEsta')
//                ->join('tcolaborador as col', 'c.codiCola', '=', 'col.codiCola')
//                ->join('testacompropago as ec', 'cf.codiEstaComproPago', '=', 'ec.codiEstaComproPago')
//                ->join('ttipocompropago as tcp', 'cf.codiTipoComproPago', '=', 'tcp.codiTipoComproPago')
//                ->select('cf.codiCotiFinal','c.numCoti','col.nombreCola','col.apePaterCola','col.apeMaterCola','c.fechaCoti','cf.numeComproPago','ec.nombreEstaPago','cf.montoTotalFactuSIGV','cf.margenFinal','tcp.nombreTipoComproPago', 'cf.estado', 'cf.utilidadFinal')
//                ->where('ce.estaCotiEsta', '=', '30')
//                ->orwhere('cf.numeComproPago','=',$query)
//                ->orderBy('cf.codiCotiFinal', 'desc')
//                ->paginate(10);

            $gastos = DB::table('tcotifinalgasto as cfg')
                ->join('tcotizacionfinal as cf', 'cf.codiCotiFinal', '=', 'cfg.codiCotiFinal')
                ->join('tcotizacion as c', 'c.codiCoti', '=', 'cf.codiCoti')
                ->join('tdetallegasto as dg', 'dg.codiCotiFinalGasto', '=', 'cfg.codiCotiFinalGasto')
                ->join('ttipocompropago as tcp', 'tcp.codiTipoComproPago', '=', 'cf.codiTipoComproPago')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'cfg.codiCola')
                ->select('cfg.codiCotiFinal','c.numCoti', 'tcp.nombreTipoComproPago','cf.numeComproPago','col.nombreCola','col.apePaterCola','col.apeMaterCola','cf.fechaHoraFin',DB::raw('SUM(dg.montoDetaGasto) as Costo'))
                ->orwhere('cf.numeComproPago','LIKE',$query)
                ->orderBy('cf.codiCotiFinal', 'desc')
                ->groupBy('cfg.codiCotiFinal')
                ->paginate(10);

            return view('gastos.index', [
                'gastos' => $gastos,
                "searchText"=>$query
            ]);
        }
    }

    public function store(Request $request){
        $categoriaGasto = CategoriaGasto::all();
        $tipoComproPago = TipoComproPago::all();

        $cotiFinal = DB::table('tcotizacionfinal as cf')
            ->join('ttipocompropago as tcp','cf.codiTipoComproPago','=','tcp.codiTipoComproPago')
            ->select('cf.codiCotiFinal','cf.codiCoti','cf.numeComproPago','cf.montoTotalFactuSIGV','tcp.nombreTipoComproPago')
            ->where('cf.codiCotiFinal','=',$request->get('txtCodiCotiFinal'))->first();

        $cotiFinalGasto = new CotiFinalGasto();
        $cotiFinalGasto->codiTipoGasto = $request->get('txtTipoGasto');
        $cotiFinalGasto->codiCotiFinal = $request->get('txtCodiCotiFinal');
        $cotiFinalGasto->fechaGasto = $request->get('txtFecha');
        $cotiFinalGasto->codiCola = $request->get('txtColaGasto');
        $cotiFinalGasto->totalGasto = $request->get('txtMonto');
        $cotiFinalGasto->estaGasto = $request->get('txtEstadoGasto');
        //obtener la cantidad de detalles amarrados a esta CotiFinalGasto
        if ( CotiFinalGasto::where('codiCotiFinal', $cotiFinal->codiCotiFinal)->count() >= 1 ){
            $cotiFinalGasto->num = (CotiFinalGasto::where('codiCotiFinal', $cotiFinal->codiCotiFinal)->count()) + 1;
        }else{
            $cotiFinalGasto->num = 1;
        }

        if ($cotiFinalGasto->save()){
            $cotizacionFinal = CotizacionFinal::findOrFail($cotiFinal->codiCotiFinal);
            $cotizacionFinal->estado = 2;
            $cotizacionFinal->update();

            $gastoPorCola = DB::table('tcotifinalgasto as cg')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'cg.codiCola')
                ->select('cg.codiCotiFinalGasto','col.codiCola','col.nombreCola', 'cg.totalGasto','cg.num')
                ->where('cg.codiCotiFinal','=',$cotiFinalGasto->codiCotiFinal)
                ->get();

            $detalleGastos = DB::table('tdetallegasto as dg')
                ->join('tcategoriagasto as cg','cg.codiCateGasto','=','dg.codiCateGasto')
                ->join('tcotifinalgasto as cf', 'cf.codiCotiFinalGasto', '=', 'dg.codiCotiFinalGasto')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'cf.codiCola')
                ->select('dg.codiDetaGasto', 'cg.nombreCateGasto', 'col.nombreCola','col.apePaterCola','col.apeMaterCola', 'dg.descripDetaGasto', 'dg.fechaRegisGasto', 'dg.montoDetaGasto')
                ->where('dg.codiCotiFinalGasto', '=', $cotiFinalGasto->getKey())->get();

            return view('cotizacionFinal.gastos', [
                'gastoPorCola' => $gastoPorCola,
                'detalleGastos' => $detalleGastos,
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
