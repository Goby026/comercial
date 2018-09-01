<?php

namespace appComercial\Http\Controllers;

use appComercial\Colaborador;
use appComercial\Costeo;
use appComercial\CosteoItem;
use appComercial\CotiCosteo;
use appComercial\Cotizacion;
use appComercial\CotizacionFinal;
use appComercial\Dolar;
use appComercial\EstaComproPago;
use appComercial\Igv;
use appComercial\Mercaderia;
use appComercial\Proveedor;
use appComercial\TipoComproPago;
use appComercial\TipoGasto;
use appComercial\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CierreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        if ($request) {
//            $query = trim($request->get('searchText'));
//        }
        $cotisFinal = DB::table('tcotizacionfinal as cf')
            ->join('tcotizacion as c', 'c.codiCoti', '=', 'cf.codiCoti')
            ->join('tcotizacionestado as ce', 'ce.codiCotiEsta', '=', 'c.codiCotiEsta')
            ->join('tcolaborador as col', 'c.codiCola', '=', 'col.codiCola')
            ->join('testacompropago as ec', 'cf.codiEstaComproPago', '=', 'ec.codiEstaComproPago')
            ->join('ttipocompropago as tcp', 'cf.codiTipoComproPago', '=', 'tcp.codiTipoComproPago')
            ->select('cf.codiCotiFinal','c.numCoti','col.nombreCola','col.apePaterCola','col.apeMaterCola','c.fechaCoti','cf.numeComproPago','ec.nombreEstaPago','cf.montoTotalFactuSIGV','cf.margenFinal','tcp.nombreTipoComproPago', 'cf.estado', 'cf.utilidadFinal')
            ->where('ce.estaCotiEsta', '=', '30')
            ->orderBy('cf.codiCotiFinal', 'desc')
            ->paginate(5);

        $colaboradores = Colaborador::all();
        $tipoGastos = TipoGasto::all();
        return view('cierres.index', [
            'tipoGastos' => $tipoGastos,
            'cotisFinal' => $cotisFinal,
            'colaboradores' => $colaboradores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
//        return Redirect::to('cierres.create');
    }


    public function cerrarCoti($codiCoti){
        $cotizacion = Cotizacion::findOrFail($codiCoti);
        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();
        $costeo = Costeo::findOrFail($cotiCosteo->codiCosteo);
        $costeoItem = CosteoItem::where('codiCosteo',$cotiCosteo->codiCosteo)->get();
        $colaborador = User::where('codiCola',$cotizacion->codiCola)->first();
        $tipoComproPago = TipoComproPago::all();
        $estadosComprobante = EstaComproPago::all();
        $proveedores = Proveedor::all();

        return view('cierres.create', [
            'cotizacion' => $cotizacion,
            'costeo' => $costeo,
            'costeoItem' => $costeoItem,
            'tipoComproPago' => $tipoComproPago,
            'estadosComprobante' => $estadosComprobante,
            'colaborador' => $colaborador,
            'proveedores' => $proveedores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //este metodo debe registrar el nuevo costeo con los datos anteriores en la tabla mercadería
    public function store(Request $request)
    {
        $mytime = Carbon::now('America/Lima');
        $dolar = Dolar::all();
        $igv = Igv::all();
        $costeo = Costeo::where('codiCosteo', $request->get('txt_codiCosteo'))->first();
        $cotizacion = Cotizacion::findOrFail($request->get('txt_codiCoti'));

//        actualizar el estado de la cotizacion
        $cotizacion->codiCotiEsta = 4;
        $cotizacion->update();

        $productos = DB::table('tcosteoitem as ci')
            ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
            ->join('tproveedor as p','ppp.codiProveedor','=','p.codiProveedor')
            ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.margenCoti', 'ci.margenVentaCoti','ci.utiCoti','ci.numPack', 'ci.precioUniSoles', 'ci.precioTotal','ci.utiCoti', 'ci.codiProveedor', 'p.nombreProveedor')
            ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        $cotizacionFinal = new CotizacionFinal();
        $cotizacionFinal->codiCoti = $request->get('txt_codiCoti');
        $cotizacionFinal->codiCola = $request->get('txt_codiCola');
        $cotizacionFinal->codiCosteo = $request->get('txt_codiCosteo');
        $cotizacionFinal->fechaHoraIni = $mytime->toDateTimeString();
        $cotizacionFinal->fechaHoraFin = null;
        $cotizacionFinal->codiTipoComproPago = $request->get('cmb_tipoComproPago');
        $cotizacionFinal->numeComproPago = $request->get('txt_numDoc');
        $cotizacionFinal->codiEstaComproPago = $request->get('cmb_estaComproPago');
        $cotizacionFinal->montoTotalFactuSIGV = $request->get('txt_montoTotal');
        $cotizacionFinal->utilidadFinal = $request->get('txt_utilidadTotal');
        $cotizacionFinal->margenFinal = $request->get('txt_margenTotal');
        $cotizacionFinal->codiIgv = "";
        $cotizacionFinal->codiDolar = "";

        if ($cotizacionFinal->save()){
            $costeoItem = CosteoItem::where('codiCosteo', $costeo->codiCosteo)->get();

            foreach ($costeoItem as $item) {
                $old_mercaderia = new Mercaderia();
                $old_mercaderia->item = $item->itemCosteo;
                $old_mercaderia->codiProveedor = $item->codiProveedor;
                $old_mercaderia->numDocumento = "";
                $old_mercaderia->cantidad = $item->cantiCoti;
                $old_mercaderia->costoUniDolarSIN = $item->precioProducDolar;
                $old_mercaderia->costoUniDolar = $item->costoUniIgv;
                $old_mercaderia->totalDolar = $item->costoTotalIgv;
                $old_mercaderia->costoUniSoles = $item->costoUniSolesIgv;
                $old_mercaderia->totalSoles = $item->costoTotalSolesIgv;
                $old_mercaderia->utilidad = $item->utiCoti;
                $old_mercaderia->codiCotiFinal = $cotizacionFinal->codiCotiFinal;
                $old_mercaderia->numPack = $item->numPack;

                $old_mercaderia->save();
            }
        }

        $mercaderia = Mercaderia::where('codiCotiFinal', $cotizacionFinal->codiCotiFinal);
        $proveedores = Proveedor::all();

        return view('cierres.mercaderia', [
            'cotizacion' => $cotizacion,
            "cotizacionFinal" => $cotizacionFinal,
            'mercaderia' => $mercaderia,
            "costeo" => $costeo,
            'productos' => $productos,
            "dolar" => $dolar->last(),
            "igv" => $igv->last(),
            'proveedores' => $proveedores
        ]);
    }

    public function setGastos($id){
        $cotizacionFinal = CotizacionFinal::findOrFail($id);
        return view('cierres.gastos', compact($cotizacionFinal));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cotizacionFinal = CotizacionFinal::findOrFail($id);
        $dolar = Dolar::all();
        $igv = Igv::all();
        $costeo = Costeo::where('codiCosteo', $cotizacionFinal->codiCosteo)->first();
        $cotizacion = Cotizacion::findOrFail($cotizacionFinal->codiCoti);

        $productos = DB::table('tcosteoitem as ci')
            ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
            ->join('tproveedor as p','ppp.codiProveedor','=','p.codiProveedor')
            ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.margenCoti', 'ci.margenVentaCoti','ci.utiCoti','ci.numPack', 'ci.precioUniSoles', 'ci.precioTotal','ci.utiCoti', 'ci.codiProveedor', 'p.nombreProveedor')
            ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        $mercaderia = Mercaderia::where('codiCotiFinal', $cotizacionFinal->codiCotiFinal)->get();
        $proveedores = Proveedor::all();

        return view('cierres.mercaderia',[
            'cotizacion' => $cotizacion,
            "cotizacionFinal" => $cotizacionFinal,
            'mercaderia' => $mercaderia,
            "costeo" => $costeo,
            'productos' => $productos,
            "dolar" => $dolar->last(),
            "igv" => $igv->last(),
            'proveedores' => $proveedores
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addItemCosteo(Request $request)
    {
        $cotiFinal = CotizacionFinal::findOrFail($request->get('txtCodiCotiFinal'));
        $old_merca = Mercaderia::where('codiCotiFinal',$cotiFinal->codiCotiFinal)->get();

        $mercaderia = new Mercaderia();
        $mercaderia->item = "";
        $mercaderia->codiProveedor = 1;
        $mercaderia->numDocumento = "";
        $mercaderia->cantidad = 0.0;
        $mercaderia->costoUniDolarSIN = 0.0;
        $mercaderia->costoUniDolar = 0.0;
        $mercaderia->totalDolar = 0.0;
        $mercaderia->costoUniSoles = 0.0;
        $mercaderia->totalSoles = 0.0;
        $mercaderia->utilidad = 0.0;
        $mercaderia->codiCotiFinal = $request->get('txtCodiCotiFinal');
        $mercaderia->numPack = count($old_merca) + 1;

//        if($mercaderia->save()){
//            return $mercaderia;
//        }else{
//            return 0;
//        }

        return $mercaderia;
    }

    public function delItemCosteo(Request $request){
        return $request->get('codiMercaderia');
    }
}
