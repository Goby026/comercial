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
use appComercial\Facturapd;
use appComercial\Igv;
use appComercial\Mercaderia;
use appComercial\MercaFacturada;
use appComercial\Proveedor;
use appComercial\TipoComproPago;
use appComercial\TipoGasto;
use appComercial\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CotizacionFinalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $cotisFinal = DB::table('tcotizacionfinal as cf')
                ->join('tcotizacion as c', 'c.codiCoti', '=', 'cf.codiCoti')
                ->join('tcotizacionestado as ce', 'ce.codiCotiEsta', '=', 'c.codiCotiEsta')
                ->join('tcolaborador as col', 'c.codiCola', '=', 'col.codiCola')
                ->join('testacompropago as ec', 'cf.codiEstaComproPago', '=', 'ec.codiEstaComproPago')
                ->join('ttipocompropago as tcp', 'cf.codiTipoComproPago', '=', 'tcp.codiTipoComproPago')
                ->select('col.codiCola','cf.codiCotiFinal', 'c.numCoti', 'col.nombreCola', 'col.apePaterCola', 'col.apeMaterCola', 'c.fechaCoti', 'cf.numeComproPago', 'ec.nombreEstaPago', 'cf.montoTotalFactuSIGV', 'cf.margenFinal', 'tcp.nombreTipoComproPago', 'cf.estado', 'cf.utilidadFinal')
                ->where('ce.estaCotiEsta', '=', '30')
//                ->orwhere('cf.numeComproPago', '=', $query)
                ->where('col.codiCola', Auth::user()->codiCola)
                ->orderBy('cf.codiCotiFinal', 'desc')
                ->paginate(10);

            $colaboradores = Colaborador::all();
            $tipoGastos = TipoGasto::all();

            return view('cotizacionFinal.index', [
                'tipoGastos' => $tipoGastos,
                'cotisFinal' => $cotisFinal,
                'colaboradores' => $colaboradores,
                "searchText" => $query
            ]);

        }
    }

    public function getCotisCerradas()
    {
        $cotisFinal = DB::select("select col.codiCola, cf.codiCotiFinal, c.numCoti, c.nomCli,col.nombreCola, col.apePaterCola, 
col.apeMaterCola, c.fechaCoti, cf.numeComproPago, ec.nombreEstaPago, cf.montoTotalFactuSIGV, 
cf.margenFinal, tcp.nombreTipoComproPago, cf.estado, cf.utilidadFinal
from tcotizacionfinal cf
inner join tcotizacion c on c.codiCoti = cf.codiCoti
inner join tcotizacionestado ce on ce.codiCotiEsta = c.codiCotiEsta
inner join tcolaborador col on c.codiCola = col.codiCola
inner join testacompropago ec on cf.codiEstaComproPago = ec.codiEstaComproPago
inner join ttipocompropago tcp on cf.codiTipoComproPago = tcp.codiTipoComproPago
where ce.estaCotiEsta = 30 and col.codiCola = '".Auth::user()->codiCola."'");

        return $cotisFinal;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cotizacion = Cotizacion::findOrFail($request->get('id'));
        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();
        $costeo = Costeo::findOrFail($cotiCosteo->codiCosteo);
        $costeoItem = CosteoItem::where('codiCosteo',$cotiCosteo->codiCosteo)->get();
        $colaborador = User::where('codiCola',$cotizacion->codiCola)->first();
        $tipoComproPago = TipoComproPago::all();
        $estadosComprobante = EstaComproPago::all();
        $proveedores = Proveedor::all();

        return view('cotizacionFinal.create', [
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //este metodo debe registrar el nuevo costeo con los datos anteriores en la tabla mercadería y tabla factura - mercaderiaFact
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
            ->join('tprecioproductoproveedor as ppp', 'ppp.idTPrecioProductoProveedor', '=', 'ci.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp', 'pp.codiProducProveedor', '=', 'ppp.codiProducProveedor')
            ->join('tproveedor as p', 'ppp.codiProveedor', '=', 'p.codiProveedor')
            ->select('ci.idCosteoItem', 'ci.itemCosteo', 'pp.nombreProducProveedor', 'ci.descCosteoItem', 'ci.cantiCoti', 'ci.precioProducDolar', 'ci.costoUniIgv', 'ci.costoTotalIgv', 'ci.costoUniSolesIgv', 'ci.costoTotalSolesIgv', 'ci.margenCoti', 'ci.margenVentaCoti', 'ci.utiCoti', 'ci.numPack', 'ci.precioUniSoles', 'ci.precioTotal', 'ci.utiCoti', 'ci.codiProveedor', 'p.nombreProveedor')
            ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

//        registra cierre de cotizacion - cotizacion final
        $cotizacionFinal = new CotizacionFinal();
        $cotizacionFinal->codiCoti = $request->get('txt_codiCoti');
        $cotizacionFinal->codiCola = $request->get('txt_codiCola');
        $cotizacionFinal->codiCosteo = $request->get('txt_codiCosteo');
        $cotizacionFinal->fechaHoraIni = $request->get('txtFecha');
        $cotizacionFinal->fechaHoraFin = null;
        $cotizacionFinal->codiTipoComproPago = $request->get('cmb_tipoComproPago');
        $cotizacionFinal->numeComproPago = $request->get('txt_numDoc');
        $cotizacionFinal->codiEstaComproPago = $request->get('cmb_estaComproPago');
        $cotizacionFinal->montoTotalCotiFinalSIGV = $request->get('txt_montoTotalCoti');
        $cotizacionFinal->montoTotalFactuSIGV = $request->get('txt_montoTotal');
        $cotizacionFinal->utilidadFinal = $request->get('txt_utilidadTotal');
        $cotizacionFinal->margenFinal = $request->get('txt_margenTotal');
        $cotizacionFinal->codiIgv = "";
        $cotizacionFinal->codiDolar = "";

        $cotizacionFinal->save();

        //registrar Factura
        $facturapd = new Facturapd();
        $facturapd->fechaEmision = $request->get('txtFechaEmision');
        $facturapd->fechaVencimiento = $request->get('txtFechaVencimiento');
        $facturapd->codiCola = $request->get('txt_codiCola');
        $facturapd->codiTipoComproPago = $request->get('cmb_tipoComproPago');
        $facturapd->codiEstaComproPago = $request->get('cmb_estaComproPago');
        $facturapd->numDocumento = $request->get('txt_numDoc');
        $facturapd->codiTipoMoneda = null;
        $facturapd->codiCotiFinal = $cotizacionFinal->codiCotiFinal;
        $facturapd->totalFactura = $request->get('txt_montoTotal');

        $facturapd->save();

        //registrar la mercaderia que se esta facturando

//        $costeoItem = CosteoItem::where('codiCosteo', $costeo->codiCosteo)->get();

        $numFacturado = $request->get('txtNumProds');

        for ($i = 1 ; $i <= $numFacturado ; $i++){
            $prodFacturado = new MercaFacturada();
            $prodFacturado->cantidad = $request->get('txtCantidad'.$i);
            $prodFacturado->item = $request->get('txtItem'.$i);
            $prodFacturado->codInterno = $request->get('txtCodInterno'.$i);
            $prodFacturado->codiProveedor = null;
            $prodFacturado->precioU = $request->get('txtPrecUnit'.$i);
            $prodFacturado->precioT = $request->get('txtValTotal'.$i);
            $prodFacturado->valorTotal = $request->get('txtValTotal'.$i);
            $prodFacturado->igv = $prodFacturado->precioT * 0.18;
            $prodFacturado->dctos = $request->get('txtDcto'.$i);
            $prodFacturado->numPack = $i;
            $prodFacturado->codiTFacturapd = $facturapd->getKey();

            $prodFacturado->save();
        }

//        foreach ($costeoItem as $item) {
//            $old_mercaderia = new Mercaderia();
//            $old_mercaderia->item = $item->itemCosteo;
//            $old_mercaderia->codiProveedor = $item->codiProveedor;
//            $old_mercaderia->numDocumento = "";
//            $old_mercaderia->cantidad = $item->cantiCoti;
//            $old_mercaderia->costoUniDolarSIN = $item->precioProducDolar;
//            $old_mercaderia->costoUniDolar = $item->costoUniIgv;
//            $old_mercaderia->totalDolar = $item->costoTotalIgv;
//            $old_mercaderia->costoUniSoles = $item->costoUniSolesIgv;
//            $old_mercaderia->totalSoles = $item->costoTotalSolesIgv;
//            $old_mercaderia->utilidad = $item->utiCoti;
//            $old_mercaderia->codiCotiFinal = $cotizacionFinal->codiCotiFinal;
//            $old_mercaderia->numPack = $item->numPack;
//
//            $old_mercaderia->save();
//        }

        $pFacturados = MercaFacturada::where('codiTFacturapd',$facturapd->getKey())->get();
        $mercaderia = Mercaderia::where('codiCotiFinal', $cotizacionFinal->getKey())->get();
        $proveedores = Proveedor::all();

        return view('cotizacionFinal.mercaderia', [
            'pFacturados' => $pFacturados,
            'cotizacion' => $cotizacion,
            'cotizacionFinal' => $cotizacionFinal,
            'mercaderia' => $mercaderia,
            'costeo' => $costeo,
            'productos' => $productos,
            'dolar' => $dolar->last(),
            'igv' => $igv->last(),
            'proveedores' => $proveedores
        ]);

//        dd($pFacturados);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cotizacionFinal = CotizacionFinal::findOrFail($id);
        $dolar = Dolar::all();
        $igv = Igv::all();
        $costeo = Costeo::where('codiCosteo', $cotizacionFinal->codiCosteo)->first();
        $cotizacion = Cotizacion::findOrFail($cotizacionFinal->codiCoti);
        $facturapd = Facturapd::where('codiCotiFinal',$id)->first();

        $pFacturados = MercaFacturada::where('codiTFacturapd',$facturapd->codiTFacturapd)->get();

        $productos = DB::table('tcosteoitem as ci')
            ->join('tprecioproductoproveedor as ppp', 'ppp.idTPrecioProductoProveedor', '=', 'ci.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp', 'pp.codiProducProveedor', '=', 'ppp.codiProducProveedor')
            ->join('tproveedor as p', 'ppp.codiProveedor', '=', 'p.codiProveedor')
            ->select('ci.idCosteoItem', 'ci.itemCosteo', 'pp.nombreProducProveedor', 'ci.descCosteoItem', 'ci.cantiCoti', 'ci.precioProducDolar', 'ci.costoUniIgv', 'ci.costoTotalIgv', 'ci.costoUniSolesIgv', 'ci.costoTotalSolesIgv', 'ci.margenCoti', 'ci.margenVentaCoti', 'ci.utiCoti', 'ci.numPack', 'ci.precioUniSoles', 'ci.precioTotal', 'ci.codiProveedor', 'p.nombreProveedor', 'ci.precioUniSoles', 'ci.precioTotal')
            ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        $mercaderia = Mercaderia::where('codiCotiFinal', $cotizacionFinal->codiCotiFinal)->get();
        $proveedores = Proveedor::all();

//        deprecated
//        return view('cotizacionFinal.mercaderia', [
//            'cotizacion' => $cotizacion,
//            "cotizacionFinal" => $cotizacionFinal,
//            'mercaderia' => $mercaderia,
//            "costeo" => $costeo,
//            'productos' => $productos,
//            "dolar" => $dolar->last(),
//            "igv" => $igv->last(),
//            'proveedores' => $proveedores
//        ]);

        return view('cotizacionFinal.mercaderia', [
            'pFacturados' => $pFacturados,
            'cotizacion' => $cotizacion,
            'cotizacionFinal' => $cotizacionFinal,
            'mercaderia' => $mercaderia,
            'costeo' => $costeo,
            'productos' => $productos,
            'dolar' => $dolar->last(),
            'igv' => $igv->last(),
            'proveedores' => $proveedores
        ]);

//        dd($facturapd);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addItemCosteo(Request $request)
    {
        $cotiFinal = CotizacionFinal::findOrFail($request->get('txtCodiCotiFinal'));
        $old_merca = Mercaderia::where('codiCotiFinal', $cotiFinal->codiCotiFinal)->get();

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
}
