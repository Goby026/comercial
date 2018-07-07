<?php

namespace appComercial\Http\Controllers;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use appComercial\Http\Requests\CotizacionFormRequest;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Costeo;
use appComercial\ContactoCliente;
use appComercial\CondicionesComerciales;
use appComercial\PrecioProductoProveedor;
use appComercial\ProductoProveedor;
use appComercial\Proveedor;
use appComercial\ProveedorContacto;
use appComercial\Cliente;
use appComercial\ClienteNatural;
use appComercial\ClienteJuridico;
use appComercial\CosteoItem;
use appComercial\TipoCliente;
use appComercial\Colaborador;
use appComercial\CotiCosteo; 
use appComercial\Cotizacion;
use appComercial\Dolar;
use appComercial\Igv;
use appComercial\Custom\MyClass;
use Carbon\Carbon;
use DB;

use PDF;
use View;
use App;

class CotizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //ID Asunto  Cliente    Producto    Fecha   Creado por  Estado  Total   Acción 
        if ($request) {
            $query = trim($request->get('searchText'));
            $cotizaciones = DB::table('tcotizacion as c')
            ->join('tcolaborador as col','c.codiCola','=','col.codiCola')
            ->join('tcotizacionestado as ce','c.codiCotiEsta','=','ce.codiCotiEsta')
            ->join('tcliente as cli','c.codiClien','=','cli.codiClien')
            ->join('tclientenatural as cn','cli.codiClienNatu','=','cn.codiClienNatu')
            ->join('tclientejuridico as cj','cli.codiClienJuri','=','cj.codiClienJuri')
            ->join('tcoticosteo as cc','c.codiCoti','=','cc.codiCoti')
            ->join('tcosteo as cos','cc.codiCosteo','=','cos.codiCosteo')
            ->join('tcosteoitem as ci','cos.codiCosteo','=','ci.codiCosteo')
            ->join('tprecioproductoproveedor as ppp','ci.idTPrecioProductoProveedor','=','ppp.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp','ppp.codiProducProveedor','=','pp.codiProducProveedor')
            ->select('c.codiCoti','c.asuntoCoti','cli.codiClien','cn.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','cn.nombreClienNatu','cj.codiClienJuri','cj.razonSocialClienJ','ce.nombreCotiEsta','pp.nombreProducProveedor','c.fechaSistema','col.nombreCola','col.apePaterCola','col.apeMaterCola','c.estado','ci.itemCosteo','ci.costoTotalSolesIgv')->distinct()//campos a mostrar de la unión
            // ->select('c.codiCoti','c.asuntoCoti','c.fechaSistema')//campos a mostrar de la unión
            ->where('c.asuntoCoti','LIKE','%'.$query.'%')
            ->where('c.estado','=',1)
            ->orwhere('cn.apePaterClienN','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
            ->orwhere('cj.razonSocialClienJ','LIKE','%'.$query.'%')
            ->orderBy('c.fechaSistema','desc')
            ->paginate(10);
            return view('cotizaciones.index',[
                "cotizaciones"=>$cotizaciones,
                "searchText"=>$query
            ]);
        }
    }

    public function create()
    {
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        $proveedoresContacto = ProveedorContacto::all();
        return view("cotizaciones.create", [
            "clientes" => $clientes, 
            "tipoClientes" => $tipoClientes,
            "proveedoresContacto" => $proveedoresContacto
        ]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
        
            $pk = new MyClass();

            $mytime = Carbon::now('America/Lima');

            // registrar cotización

            $cotizacion = new Cotizacion();
            $cotizacion->codiCoti = $pk->pk_generator("COT");
            $cotizacion->fechaCoti = $mytime->toDateTimeString();
            $cotizacion->asuntoCoti = null;
            $cotizacion->codiClien = null;
            $cotizacion->codiTipoCliente = null;
            $cotizacion->codiCola = null;
            $cotizacion->tiemCoti = null;
            $cotizacion->codiCotiEsta = null;
            $cotizacion->estado = 1;

            $cotizacion->save();

            //registrar Costeo
            $costeo = new Costeo();
            $costeo->codiCosteo = $pk->pk_generator("COS");
            $costeo->fechaIniCosteo = $mytime->toDateTimeString();
            $costeo->fechaFinCosteo = null;
            $costeo->costoTotalDolares = null;
            $costeo->costoTotalSoles = null;
            $costeo->totalVentaSoles = null;
            $costeo->utilidadVentaSoles = null;
            $costeo->margenCosto = null;
            $costeo->margenVenta = null;
            $costeo->codiCosteoEsta = null;
            $costeo->codiCola = null;
            $costeo->codiIgv = null;
            $costeo->codiDolar = null;

            $costeo->save();

            //registrar CotiCosteo

            $cotiCosteo = new CotiCosteo();
            $cotiCosteo->codiCosteo = $costeo->codiCosteo;
            $cotiCosteo->codiCoti = $cotizacion->codiCoti;
            $cotiCosteo->codiCola = $request->get('txt_codiCola');
            $cotiCosteo->estado = 1;

            $cotiCosteo->save();

            //registrar CosteoItem
            $costeoItem = new CosteoItem();
            $costeoItem->codiCosteo = $costeo->codiCosteo;
            $costeoItem->idTPrecioProductoProveedor = 1;
            $costeoItem->itemCosteo = 'Some product';
            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = 1;
            $costeoItem->precioProducDolar = 0.0;
            $costeoItem->costoUniIgv = 0.0;
            $costeoItem->costoTotalIgv = 0.0;
            $costeoItem->costoUniSolesIgv = 0.0;
            $costeoItem->costoTotalSolesIgv = 0.0;
            $costeoItem->margenCoti = 0.01;
            $costeoItem->utiCoti = 0.3;
            $costeoItem->margenVentaCoti = 0.03;
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = 1;
            $costeoItem->codiProveeContac = 'pc001';
            $costeoItem->estado = 1;

            $costeoItem->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        $proveedores = Proveedor::all();
        $proveedoresContacto = ProveedorContacto::all();
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('estadoTipoCliJur','=','1')->get();
        $dolar = Dolar::all();
        $igv = Igv::all();
        $clientes = DB::table('tcliente as c')
        ->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
        ->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
        ->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
        ->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
        ->where('c.estado','=',1)->get();
        // return view("cotizaciones.create", ["clientes" => $clientes, "tipoClientes"=> $tipoClientes])->with('cotizacion',$cotizacion->codiCoti);
        return view("cotizaciones.create", [
            "tipoClientesJuridicos"=>$tipoClienteJuridico,
            "proveedores"=>$proveedores,
            "proveedoresContacto"=>$proveedoresContacto,
            "clientes" => $clientes, 
            "tipoClientes"=> $tipoClientes
        ])
        ->with('cotizacion',$cotizacion->codiCoti)
        ->with('costeo',$costeo->codiCosteo)
        ->with("dolar",$dolar->last())
        ->with("igv",$igv->last());
    }

    public function show($codiSedeJuridico)
    {
        return view('cotizaciones.show', ["SedesJuridico" => SedeJuridico::findOrFail($codiSedeJuridico)]);
    }

    public function busqueda()
    {
        return view('cotizaciones.search');
    }

    public function edit($codiSedeJuridico)
    {
        $SedeJuridico = SedeJuridico::findOrFail($codiSedeJuridico);
        $clientesJuridico = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        //print_r($clientesJuridico);
        return view('cotizaciones.edit', ["SedeJuridico" => $SedeJuridico, "clientesJuridico" => $clientesJuridico]);
    }

    public function update(Request $request)
    {
        if ($request->get('btn_vista_tabla') !== null) {            
            for ($i=1; $i < 4; $i++) {
                echo $request->get("txt_descripcion{$i}");
                echo "<br>";
            }
        }else{
            $mytime = Carbon::now('America/Lima');

            $cotizacion = Cotizacion::findOrFail($request->get('txt_codiCoti'));
            $cotizacion->asuntoCoti = $request->get('txt_asuntoCoti');
            $cotizacion->codiClien = $request->get('txt_cliente');
            $cotizacion->codiTipoCliente = null;
            $cotizacion->codiCola = $request->get('txt_codiCola');
            $cotizacion->tiemCoti = null;
            if (isset($request['btn_pre'])) {//PRE COTIZACION
                $cotizacion->codiCotiEsta = 'CE_17_5_201838412102111951367';
            }else if(isset($request['btn_coti'])){
                $cotizacion->codiCotiEsta = 'CE_17_5_201881295764310211311';
            }
            $cotizacion->estado = 1;

            $cotizacion->update();

            //actualizar Costeo

            $costeo = Costeo::findOrFail($request->get('txt_codiCosteo'));
            $costeo->fechaIniCosteo = $cotizacion->fechaCoti;
            $costeo->fechaFinCosteo = null;
            $costeo->costoTotalDolares = $request->get('txt_total_dolar');
            $costeo->costoTotalSoles = $request->get('txt_total_soles');
            $costeo->totalVentaSoles = $request->get('txt_ventaTotal');
            $costeo->utilidadVentaSoles = $request->get('txt_utilidadTotal');
            $costeo->margenCosto = $request->get('txt_margen_cu_soles');
            $costeo->margenVenta = $request->get('txt_margenTotal');
            if (isset($request['btn_pre'])) {//PRE COTIZACION
                $costeo->codiCosteoEsta = 'CE_10_5_201891310112387125416';//en construccion
            }else if(isset($request['btn_coti'])){
                $costeo->codiCosteoEsta = 'CE_10_5_201810118246512711339';//activo
            }        
            $costeo->codiCola = $request->get('txt_codiCola');
            $costeo->codiIgv = $request->get('txt_igv');
            $costeo->codiDolar = $request->get('txt_dolar');

            $costeo->update();

            //actualizar CosteoItem
            // foreach ($variable as $value) {//se debe realizar un ciclo por si hay mas productos en una cotización
            //     # code...
            // }
            $costeoItem = CosteoItem::findOrFail($request->get('txt_idCosteoItem'));
            $costeoItem->codiCosteo = $request->get('txt_codiCosteo');
            $costeoItem->idTPrecioProductoProveedor = 2;
            $costeoItem->itemCosteo = $request->get('txt_producto');
            $costeoItem->descCosteoItem = $request->get('txt_descripcion');
            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = $request->get('txt_cantidad');
            $costeoItem->precioProducDolar = $request->get('txt_cus_dolar_sin');
            $costeoItem->costoUniIgv = $request->get('txt_cus_dolar');
            $costeoItem->costoTotalIgv = $request->get('txt_total_dolar');
            $costeoItem->costoUniSolesIgv = $request->get('txt_cus_soles');
            $costeoItem->costoTotalSolesIgv = $request->get('txt_total_soles');
            $costeoItem->margenCoti = $request->get('txt_margen_cu_soles');
            $costeoItem->utiCoti = $request->get('txt_utilidadTotal');
            $costeoItem->margenVentaCoti = $request->get('txt_margenTotal');
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = 1;
            $costeoItem->codiProveeContac = $request->get('txt_atencion');
            
            $costeoItem->estado = 1;

            $costeoItem->update();

            return Redirect::to('cotizaciones');
        }
    }

    public function destroy($codiClienteJuridico)
    {
        $cotiCosteo = CotiCosteo::findOrFail('COS_25_5_201823112611910758413');
        $cotiCosteo->estadoSedeJur = 0;
        $cotiCosteo->update();
        return Redirect::to('cotizaciones');
    }

    public function verCoti(){
        $colaboradores = DB::table('tcolaborador')->where('estado', '=', '1')->get();
        return view('cotizaciones.cotiCola',["colaboradores"=>$colaboradores]);
    }

    public function detalleCoti($codiCola){
        $colaborador = Colaborador::findOrFail($codiCola);
        return view('cotizaciones.detalleCoti',["colaborador"=>$colaborador]);
    }

    public function continuar($codiCoti){
        //devolver todos los datos necesarios para cargar la vista de "Nueva cotizacion"
        $coti_continue = Cotizacion::findOrFail($codiCoti);

        $cliente_continue = DB::table('tcliente')->where('codiClien', '=', $coti_continue->codiClien)->get();//el metodo DB no devuelve un objeto se debe deserializar para acceder a los campos como un array
        //verificar si es cliente juridico o natural
        $cli = [];
        foreach ($cliente_continue as $cliente)
        {
            $cli = $cliente;
        }

        if ($cli->codiClienJuri == '001') { //si es 001 entonces es cliente natural
            $_cliente = ClienteNatural::findOrFail($cli->codiClienNatu);
        }else{//sino es un cliente juridico
            $_cliente = ClienteJuridico::findOrFail($cli->codiClienJuri);
        }
        
        $cotiCosteo = CotiCosteo::where('codiCoti',$coti_continue->codiCoti)->firstOrFail();
        
        // obtener el costeo
        $costeo = Costeo::where('codiCosteo',$cotiCosteo->codiCosteo)->firstOrFail();

        $costeosItems = DB::table('tcosteoitem as ci')
        ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
        ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv','ci.numPack' ,'ci.margenCoti')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();//se envia este arreglo a la vista

        $cItem = CosteoItem::where('codiCosteo',$cotiCosteo->codiCosteo)->firstOrFail();

        $proveedores = Proveedor::all();

        $proveedoresContacto = ProveedorContacto::all();

        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $dolar = Dolar::all();
        $igv = Igv::all();
        $tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('estadoTipoCliJur','=','1')->get();

        $clientes = DB::table('tcliente as c')
        ->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
        ->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
        ->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
        ->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
        ->where('c.estado','=',1)->get();

        $productos = DB::table('tproductoproveedor as pp')
        ->join('tprecioproductoproveedor as ppp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
        ->select('pp.codiProducProveedor','ppp.idTPrecioProductoProveedor','pp.nombreProducProveedor')->get();

        return view('cotizaciones.create',[
            "productos"=>$productos,
            "tipoClientesJuridicos"=>$tipoClienteJuridico,
            "proveedoresContacto"=>$proveedoresContacto,
            "proveedores"=>$proveedores,
            "cItem"=>$cItem,
            "costeosItems"=>$costeosItems,
            "coti_continue"=>$coti_continue,
            "clientes"=>$clientes,
            "_cliente"=>$_cliente,
            "tipoClientes"=>$tipoClientes,
            "dolar"=>$dolar->last(),
            "igv"=>$igv->last()
        ])
        ->with("cotizacion",$coti_continue->codiCoti)
        ->with("costeo",$costeo->codiCosteo);
    }

    public function find_by_params(Request $request){

        if ($request->get('txt_find_producto') != "") {
            $campo = 'ci.itemCosteo';
            $valor = $request->get('txt_find_producto');
        }else if($request->get('txt_find_codiCoti') != ""){
            $campo = 'c.codiCoti';
            $valor = $request->get('txt_find_codiCoti');
        }else if($request->get('txt_find_asunto') != ""){
            $campo = 'c.asuntoCoti';
            $valor = $request->get('txt_find_asunto');
        }else if($request->get('txt_find_cliente') != ""){
            $campo = 'cj.razonSocialClienJ';
            $valor = $request->get('txt_find_cliente');
        }
        
        $cotizaciones = DB::table('tcotizacion as c')
        ->join('tcolaborador as col','c.codiCola','=','col.codiCola')
        ->join('tcotizacionestado as ce','c.codiCotiEsta','=','ce.codiCotiEsta')
        ->join('tcliente as cli','c.codiClien','=','cli.codiClien')
        ->join('tclientenatural as cn','cli.codiClienNatu','=','cn.codiClienNatu')
        ->join('tclientejuridico as cj','cli.codiClienJuri','=','cj.codiClienJuri')
        ->join('tcoticosteo as cc','c.codiCoti','=','cc.codiCoti')
        ->join('tcosteo as cos','cc.codiCosteo','=','cos.codiCosteo')
        ->join('tcosteoitem as ci','cos.codiCosteo','=','ci.codiCosteo')
        ->join('tprecioproductoproveedor as ppp','ci.idTPrecioProductoProveedor','=','ppp.idTPrecioProductoProveedor')
        ->join('tproductoproveedor as pp','ppp.codiProducProveedor','=','pp.codiProducProveedor')
            ->select('c.codiCoti','c.asuntoCoti','cli.codiClien','cn.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','cn.nombreClienNatu','cj.codiClienJuri','cj.razonSocialClienJ','ce.nombreCotiEsta','pp.nombreProducProveedor','c.fechaSistema','col.nombreCola','col.apePaterCola','col.apeMaterCola','c.estado','ci.itemCosteo','ci.costoTotalSolesIgv')//campos a mostrar de la unión
            // ->select('c.codiCoti','c.asuntoCoti','c.fechaSistema')//campos a mostrar de la unión            
            ->where($campo,'LIKE','%'.$valor.'%')
            ->where('c.estado','=',1)
            ->orderBy('c.fechaSistema','desc')
            ->paginate(10);

            return view('cotizaciones.index',[
                "cotizaciones"=>$cotizaciones
            ]);
        }

    public function asistirCoti(){
        $colaborador = DB::table('tcolaborador')->where('estado','=','1')
            ->orderBy('nombreCola','desc')
            ->paginate(5);
        return view('cotizaciones.asistirCotizacion',["colaborador"=>$colaborador]);
    }

    public function find_by_cola($codiCola){
        $cotis_cola = DB::table('tcotizacion as c')
                ->join('tcotizacionestado as ce','c.codiCotiEsta','=','ce.codiCotiEsta')
                ->select('c.codiCoti','c.fechaCoti','c.asuntoCoti','ce.nombreCotiEsta')
                ->where('c.codiCola', '=', $codiCola)->get();

        return view('cotizaciones.cotiPorCola',["cotis_cola"=>$cotis_cola]);
    }

    public function getPdf($coti){
        //devolver todos los datos necesarios para cargar la vista de "Nueva cotizacion"
        $cotizacion = Cotizacion::findOrFail($coti);

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = Costeo::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        // $costeoItem = CosteoItem::where('codiCosteo', $costeo->codiCosteo)->get();

        $productos = DB::table('tcosteoitem as ci')
        ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
        ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.margenCoti')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        $cliente = Cliente::where('codiClien', $cotizacion->codiClien)->first();
        
        //verificar si es cliente juridico o natural
        if ($cliente->codiClienJuri == '001') { //si es 001 entonces es cliente natural
            $_cliente = ClienteNatural::findOrFail($cliente->codiClienNatu);
        }else{//sino es un cliente juridico
            $_cliente = ClienteJuridico::findOrFail($cliente->codiClienJuri);
            $contactoCliente = ContactoCliente::where('codiClienJuri',$_cliente->codiClienJuri)->first();
        }

        $condicionesCom = CondicionesComerciales::all();

        $view = View::make('cotizaciones.pdfCoti',compact('_cliente','cotizacion' ,'contactoCliente', 'condicionesCom', 'productos'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('cotizacion'.'.pdf');
    }

    // public function addCosteoItem($codiCoti){
    public function addCosteoItem(Request $request){

        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($request->get('codiCoti'));

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = Costeo::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        $costeoItem = new CosteoItem();

        $costeoItem->codiCosteo = $costeo->codiCosteo;
        $costeoItem->idTPrecioProductoProveedor = 1;
        $costeoItem->itemCosteo = "Descripción";
        $costeoItem->descCosteoItem = "";
        $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
        $costeoItem->cantiCoti = 0;
        $costeoItem->precioProducDolar = 0;
        $costeoItem->costoUniIgv = 0;
        $costeoItem->costoTotalIgv = 0;
        $costeoItem->costoUniSolesIgv = 0;
        $costeoItem->costoTotalSolesIgv = 0;
        $costeoItem->margenCoti = 0;
        $costeoItem->utiCoti = 0;
        $costeoItem->margenVentaCoti = 0;
        $costeoItem->fechaCosteoActu = 0;
        $costeoItem->numPack = 1;
        $costeoItem->codiProveeContac = null;
        $costeoItem->estado = 1;

        if ($costeoItem->save()) {
            return "1";
        }else{
            return "0";
        }
        
    }

    //metodo para ver la cotizacion como excel
    public function getCotizacion($codiCoti){

        $cotizacion = Cotizacion::findOrFail($codiCoti);

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = Costeo::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        // $costeoItem = CosteoItem::where('codiCosteo', $costeo->codiCosteo)->get();

        $productos = DB::table('tcosteoitem as ci')
        ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
        ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.margenCoti')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        return view('cotizaciones.vistaCoti', compact('productos', 'cotizacion'));
    }
    
}
