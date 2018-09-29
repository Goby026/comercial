<?php

namespace appComercial\Http\Controllers;

use appComercial\CotizacionFinal;
use appComercial\Igv;
use appComercial\Mercaderia;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class MercaderiaController extends Controller
{
    public function saveMercaderia(Request $request)
    {

        $igv = Igv::findOrFail('IGV_23_7_201811128511396731024');
        $valorIgv = $igv->valorIgv;

        //setear los datos
        $cotiFinal = CotizacionFinal::findOrFail($request->get('codiCotiFinal'));
        $cotiFinal->montoTotalCotiFinalSIGV = $request->get('montoTotalCotiFinalSIGV') / (($valorIgv / 100) + 1);
        $cotiFinal->montoTotalFactuSIGV = $request->get('montoTotalFactuSIGV') / (($valorIgv / 100) + 1);
        $cotiFinal->utilidadFinal = $request->get('txtComTotalUTILIDAD');
        $cotiFinal->margenFinal = $request->get('txtComTotalMARGEN');
//        $cotiFinal->balanceDolares = $request->get('txtMontoTotalDolar');
//        $cotiFinal->balanceSoles = $request->get('txtMontoTotalSoles');
//        $cotiFinal->estado = $request->get('');

        $cotiFinal->update();

//        dd($cotiFinal);

        $cantidad_merca = $request->get('cantMerca');
//        $mercaderias = Mercaderia::where('codiCotiFinal',$request->get('codiCotiFinal'))->get();

//        ciclo para recorrer cada elemento de mercaderia
//        for ($i = 1; $i <= $cantidad_merca; $i++) {
//            if ($request->get('updateMerca')){
//                $merca = Mercaderia::findOrFail('txtCodiMercaderia'. $i);
//            }else{
//                $merca = new Mercaderia();
//            }
//
//            $merca->codInterno = $request->get('txtCodInt' . $i);
//            $merca->item = $request->get('txt_new_merca' . $i);
//            $merca->codiProveedor = $request->get('txt_prov_merca' . $i);
//            $merca->numDocumento = $request->get('txt_num_doc' . $i);
//            $merca->cantidad = $request->get('txt_canti_merca' . $i);
//            $merca->costoUniDolarSIN = $request->get('txtComCUD' . $i);
//            $merca->costoUniDolar = $request->get('txtComCUD' . $i) * ($valorIgv / 100);
//            $merca->totalDolar = $request->get('txtComCTD' . $i);
//            $merca->costoUniSoles = $request->get('txtComCUS' . $i);
//            $merca->totalSoles = $request->get('txtComCTS' . $i);
//            $merca->utilidad = $request->get('txtComUtilidad' . $i);
//            $merca->margen = $request->get('txtComMargen' . $i);
//            $merca->codiCotiFinal = $request->get('codiCotiFinal'. $i);
//            $merca->numPack = $i;
//
//            if ($request->get('updateMerca')){
//                $merca->update();
//            }else{
//                $merca->save();
//            }
//        }
        dd($request);
    }
}
