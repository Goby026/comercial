<?php

namespace appComercial\Http\Controllers;

use appComercial\CategoriaGasto;
use appComercial\CotiFinalGasto;
use appComercial\Mercaderia;
use appComercial\CotizacionFinal;
use appComercial\TipoComproPago;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CotiFinalGastoController extends Controller
{
    public function index()
    {
        return view('gastos.index');
    }

    public function getGastos(Request $request)
    {
        $gastos = DB::select("select c.numCoti, c.nomCli, col.nombreCola, cf.fechaHoraIni, sum(round(cfg.totalGasto, 2)) as monto
from tcotifinalgasto cfg
inner join tcolaborador col on col.codiCola = cfg.codiCola
inner join tcotizacionfinal cf on cf.codiCotiFinal = cfg.codiCotiFinal
inner join tcotizacion c on c.codiCoti = cf.codiCoti
group by c.numCoti");

        return $gastos;
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

//        dd($cotiFinalGasto);

        if ($cotiFinalGasto->save()){
            $cotizacionFinal = CotizacionFinal::findOrFail($cotiFinal->codiCotiFinal);
            $cotizacionFinal->estado = 2;
            $cotizacionFinal->update();

            $gastoPorCola = DB::table('tcotifinalgasto as cg')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'cg.codiCola')
                ->select('cg.codiCotiFinalGasto','col.codiCola','col.nombreCola', 'cg.totalGasto','cg.num')
                ->where('cg.codiCotiFinal','=',$cotiFinalGasto->codiCotiFinal)
                ->get();

            $mercaderia = Mercaderia::where('codiCotiFinal', $cotizacionFinal->codiCotiFinal)->get();

            $detalleGastos = DB::table('tdetallegasto as dg')
                ->join('tcategoriagasto as cg','cg.codiCateGasto','=','dg.codiCateGasto')
                ->join('tcotifinalgasto as cf', 'cf.codiCotiFinalGasto', '=', 'dg.codiCotiFinalGasto')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'cf.codiCola')
                ->select('dg.codiDetaGasto', 'cg.nombreCateGasto', 'col.nombreCola','col.apePaterCola','col.apeMaterCola', 'dg.descripDetaGasto', 'dg.fechaRegisGasto', 'dg.montoDetaGasto')
                ->where('dg.codiCotiFinalGasto', '=', $cotiFinalGasto->getKey())->get();

            return view('cotizacionFinal.gastos', [
                'gastoPorCola' => $gastoPorCola,
                'detalleGastos' => $detalleGastos,
                'mercaderia' => $mercaderia,
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
