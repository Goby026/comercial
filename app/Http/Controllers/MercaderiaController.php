<?php

namespace appComercial\Http\Controllers;

use appComercial\CotizacionFinal;
use appComercial\Mercaderia;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class MercaderiaController extends Controller
{
    public function saveMercaderia(Request $request){

    //setear los datos
        $cotiFinal = CotizacionFinal::findOrFail($request->get('codiCotiFinal'));
        $cotiFinal->balanceDolares = $request->get('txtMontoTotalDolar');
        $cotiFinal->balanceSoles = $request->get('txtMontoTotalSoles');

        $cotiFinal->update();

//        dd($cotiFinal);

        $cantidad_merca = $request->get('cantMerca');
        $mercaderias = Mercaderia::where('codiCotiFinal',$request->get('codiCotiFinal'))->get();

//        ciclo para recorrer cada elemento de mercaderia
        $i = 1;
        foreach ($mercaderias as $mercaderia){

            $mercaderia->codInterno = $request->get('txt_codInternoFact'.$i);
            $mercaderia->item = $request->get('txt_new_merca'.$i);
            $mercaderia->codiProveedor = $request->get('txt_prov_merca'.$i);
            $mercaderia->numDocumento = $request->get('txt_num_doc'.$i);
            $mercaderia->cantidad = $request->get('txt_canti_merca'.$i);
            $mercaderia->costoUniDolarSIN = $request->get('txt_cusd_sin_merca'.$i);
            $mercaderia->costoUniDolar = $request->get('txt_cus_merca'.$i);
            $mercaderia->totalDolar = $request->get('txt_totald_merca'.$i);
            $mercaderia->costoUniSoles = $request->get('txt_cussol_merca'.$i);
            $mercaderia->totalSoles = $request->get('txt_totSoles_merca'.$i);
            $mercaderia->utilidad = $request->get('txt_utilidad_merca'.$i);
            $mercaderia->codiCotiFinal = $request->get('codiCotiFinal');
//            $mercaderia->numPack = $request->get('cantMerca'.$i);

            if ($mercaderia->update()){
                $i++;
            }
        }

        if ($i > 1){
            return view('cotizacionFinal.index');
        }else{
            return "ERROR";
        }
    }
}
