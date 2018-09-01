<?php

namespace appComercial\Http\Controllers;

use appComercial\DetalleGasto;
use Carbon\Carbon;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class DetalleGastoController extends Controller
{
    public function store(Request $request){

        $mytime = Carbon::now('America/Lima');

        $detalleGasto = new DetalleGasto();
        $detalleGasto->codiCateGasto = $request->get('txtCategoria');
        $detalleGasto->codiTipoComproPago = $request->get('txtComprobante');
        $detalleGasto->numeComproPago = $request->get('txtNumCompro');
        $detalleGasto->montoDetaGasto = $request->get('txtMonto');
        $detalleGasto->fechaDetaGasto = $request->get('txtFecha');
//        $detalleGasto->descripDetaGasto = $request->get('txtDescripcion');
        $detalleGasto->descripDetaGasto = "GASTO ##1245";
        $detalleGasto->estaDetaGasto = $request->get('txtEstado');
        $detalleGasto->fechaRegisGasto = $mytime->toDateTimeString();
        $detalleGasto->origen = $request->get('txtOrigen');
        $detalleGasto->destino = $request->get('txtDestino');
        $detalleGasto->tiempo_horas = $request->get('txtTiempo');
        $detalleGasto->codiCotiFinalGasto = $request->get('');
        $detalleGasto->codiProveedor = $request->get('');

        return $detalleGasto;
    }
}
