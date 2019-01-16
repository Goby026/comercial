<?php

namespace appComercial\Http\Controllers;

use appComercial\CategoriaGasto;
use appComercial\CotiFinalGasto;
use appComercial\DetalleGasto;
use appComercial\Http\Controllers\Api\ApiController;
use appComercial\TipoComproPago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleGastoController extends ApiController
{
    public function store(Request $request)
    {

//        $query = DB::select(DB::raw("select c.codiCola, col.nombreCola, count(c.codiCoti),
//        (select count(codiCotiFinal) from tcotizacionfinal where codiCola = c.codiCola)
//        from tcotizacion c
//        inner join tcolaborador col on col.codiCola = c.codiCola
//        group by c.codiCola"));

        $mytime = Carbon::now('America/Lima');

        $detalleGasto = new DetalleGasto();
        $detalleGasto->codiCateGasto = $request->get('txtCategoria');
        $detalleGasto->codiTipoComproPago = $request->get('txtComprobante');
        $detalleGasto->numeComproPago = $request->get('txtNumComprobante');
        $detalleGasto->montoDetaGasto = $request->get('txtMonto');
        $detalleGasto->fechaDetaGasto = $request->get('txtFecha');
        $detalleGasto->descripDetaGasto = $request->get('txtDescripcion');
        $detalleGasto->estaDetaGasto = 1;
        $detalleGasto->fechaRegisGasto = $mytime->toDateTimeString();
        $detalleGasto->origen = $request->get('txtOrigen');
        $detalleGasto->destino = $request->get('txtDestino');
        $detalleGasto->tiempo_horas = $request->get('txtTiempo');
        $detalleGasto->codiCotiFinalGasto = $request->get('txtcodiCotiFinalGasto');
        $detalleGasto->codiProveedor = $request->get('txtEmpresa');

        $detalleGasto->save();

        $detalleGastos = DB::table('tdetallegasto as dg')
            ->join('tcategoriagasto as cg', 'cg.codiCateGasto', '=', 'dg.codiCateGasto')
            ->join('tcotifinalgasto as cf', 'cf.codiCotiFinalGasto', '=', 'dg.codiCotiFinalGasto')
            ->join('tcolaborador as col', 'col.codiCola', '=', 'cf.codiCola')
            ->select('dg.codiDetaGasto', 'cg.nombreCateGasto', 'col.nombreCola', 'col.apePaterCola', 'col.apeMaterCola', 'dg.descripDetaGasto', 'dg.fechaRegisGasto', 'dg.montoDetaGasto')
            ->where('dg.codiDetaGasto', '=', $detalleGasto->getKey())->first();

        return response()->json($detalleGastos);
    }


    public function setGastos($id)
    {
        $categoriaGasto = CategoriaGasto::all();
        $tipoComproPago = TipoComproPago::all();
        $cotiFinal = DB::table('tcotizacionfinal as cf')
            ->join('ttipocompropago as tcp', 'cf.codiTipoComproPago', '=', 'tcp.codiTipoComproPago')
            ->select('cf.codiCotiFinal', 'cf.numeComproPago', 'cf.montoTotalFactuSIGV', 'tcp.nombreTipoComproPago')
            ->where('cf.codiCotiFinal', '=', $id)->first();

        $cotiFinalGasto = CotiFinalGasto::where('codiCotiFinal', $id)->first();

        $gastoPorCola = DB::table('tcotifinalgasto as cg')
            ->join('tcolaborador as col', 'col.codiCola', '=', 'cg.codiCola')
            ->select('cg.codiCotiFinalGasto', 'col.codiCola', 'col.nombreCola', 'cg.totalGasto', 'cg.num')
            ->where('cg.codiCotiFinal', '=', $cotiFinalGasto->codiCotiFinal)
            ->get();

        $detalleGastos = DB::table('tdetallegasto as dg')
            ->join('tcategoriagasto as cg', 'cg.codiCateGasto', '=', 'dg.codiCateGasto')
            ->join('tcotifinalgasto as cf', 'cf.codiCotiFinalGasto', '=', 'dg.codiCotiFinalGasto')
            ->join('tcolaborador as col', 'col.codiCola', '=', 'cf.codiCola')
            ->select('cf.codiCotiFinal', 'dg.codiDetaGasto', 'cg.nombreCateGasto', 'col.codiCola', 'col.nombreCola', 'col.apePaterCola', 'col.apeMaterCola', 'dg.descripDetaGasto', 'dg.fechaRegisGasto', 'dg.montoDetaGasto')
            ->where('cf.codiCotiFinal', '=', $cotiFinalGasto->codiCotiFinal)->get();

//        dd($cotiFinalGasto);

        return view('cotizacionFinal.gastos', [
            'gastoPorCola' => $gastoPorCola,
            'cotiFinal' => $cotiFinal,
            'categoriaGasto' => $categoriaGasto,
            'tipoComproPago' => $tipoComproPago,
            'cotiFinalGasto' => $cotiFinalGasto,
            'detalleGastos' => $detalleGastos
        ]);

    }

    public function getDetalleGasto($id)
    {

        $data = [];

        $detalleGastos = DB::select("select  cfg.fechaGasto, dg.numeComproPago, dg.montoDetaGasto, cg.nombreCateGasto, tc.nombreTipoComproPago
from tcotifinalgasto cfg
inner join tdetallegasto dg on cfg.codiCotiFinalGasto = dg.codiCotiFinalGasto
inner join tcategoriagasto cg on dg.codiCateGasto = cg.codiCateGasto
inner join ttipocompropago tc on dg.codiTipoComproPago = tc.codiTipoComproPago
where cfg.codiCotiFinal = $id");

        $data['detalles'] = $detalleGastos;

        return $this->sendResponse($data, "Detalles de gasto recuperados.");

    }
}
