<?php

namespace appComercial\Http\Controllers;

use appComercial\CotizacionFinal;
use appComercial\Igv;
use appComercial\Mercaderia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MercaderiaController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth');
//    }

    public function saveMercaderia(Request $request)
    {
        $igv = Igv::findOrFail('IGV_23_7_201811128511396731024');
        $valorIgv = $igv->valorIgv;

        //setear los datos
        $cotiFinal = CotizacionFinal::findOrFail($request->get('codiCotiFinal'));
        $cotiFinal->montoTotalCotiFinalSIGV = $request->get('txtComTotalCTS');//monto total costeado
        $cotiFinal->montoTotalFactuSIGV = $request->get('txtComTotalCTS') + $request->get('txtComTotalUTILIDAD');//monto facturado
        $cotiFinal->utilidadFinal = $request->get('txtComTotalUTILIDAD');
        $cotiFinal->margenFinal = $request->get('txtComTotalMARGEN');
        $cotiFinal->balanceDolares = $request->get('txtMontoTotalDolar');
        $cotiFinal->balanceSoles = $request->get('txtMontoTotalSoles');
        if ($request->get('btnFinalizar') == 1) {
            $cotiFinal->estado = 2;
        } else {
            $cotiFinal->estado = 1;
        }
        $cotiFinal->update();

        $cantidad_merca = $request->get('cantMerca');

        //comprobar si hay registro de mercaderia de las cotizacion final
        if (Mercaderia::where('codiCotiFinal', $request->get('codiCotiFinal'))->exists()) {
            //actualizar
            for ($i = 1; $i <= $cantidad_merca; $i++) {
                $merca = Mercaderia::findOrFail($request->get('txtCodiMercaderia' . $i));
                $merca->codInterno = $request->get('txtCodInt' . $i);
                $merca->item = $request->get('txt_new_merca' . $i);
                $merca->codiProveedor = $request->get('txt_prov_merca' . $i);
                $merca->numDocumento = $request->get('txt_num_doc' . $i);
                $merca->cantidad = $request->get('txt_canti_merca' . $i);
                $merca->costoUniDolarSIN = $request->get('txtComCUD' . $i);
                $merca->costoUniDolar = $request->get('txtComCUD' . $i) + ($request->get('txtComCUD' . $i) * ($valorIgv / 100));
                $merca->totalDolar = $request->get('txtComCTD' . $i);
                $merca->costoUniSoles = $request->get('txtComCUS' . $i);
                $merca->totalSoles = $request->get('txtComCTS' . $i);
                $merca->utilidad = $request->get('txtComUtilidad' . $i);
                $merca->margen = $request->get('txtComMargen' . $i);
                $merca->codiCotiFinal = $request->get('codiCotiFinal');
                $merca->numPack = $i;
                $merca->update();
            }
        } else {
            //crear nueva mercaderia
            for ($i = 1; $i <= $cantidad_merca; $i++) {
                $merca = new Mercaderia();
                $merca->codInterno = $request->get('txtCodInt' . $i);
                $merca->item = $request->get('txt_new_merca' . $i);
                $merca->codiProveedor = $request->get('txt_prov_merca' . $i);
                $merca->numDocumento = $request->get('txt_num_doc' . $i);
                $merca->cantidad = $request->get('txt_canti_merca' . $i);
                $merca->costoUniDolarSIN = $request->get('txtComCUD' . $i);
                $merca->costoUniDolar = $request->get('txtComCUD' . $i) + ($request->get('txtComCUD' . $i) * ($valorIgv / 100));
                $merca->totalDolar = $request->get('txtComCTD' . $i);
                $merca->costoUniSoles = $request->get('txtComCUS' . $i);
                $merca->totalSoles = $request->get('txtComCTS' . $i);
                $merca->utilidad = $request->get('txtComUtilidad' . $i);
                $merca->margen = $request->get('txtComMargen' . $i);
                $merca->codiCotiFinal = $request->get('codiCotiFinal');
                $merca->numPack = $i;
                $merca->save();
            }
        }

        return Redirect::to('cotizacionFinal');
    }


    public function prueba(Request $request)
    {
        $query = DB::select('select c.codiCola, col.nombreCola, count(c.codiCoti) as cantiCoti, 
                            (select count(codiCotiFinal) from tcotizacionfinal where codiCola = c.codiCola)  as finalizados from tcotizacion c
                            inner join tcolaborador col on col.codiCola = c.codiCola
                            group by c.codiCola');
        return $query;
    }
}
