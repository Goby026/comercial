<?php

namespace appComercial\Http\Controllers;

use appComercial\Cargo;
use appComercial\CotiCondiciones;
use appComercial\TipoClienteJuridico;
use appComercial\User;
use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Costeo;
use appComercial\ContactoCliente;
use appComercial\CondicionesComerciales;
use appComercial\Contrato;
use appComercial\Proveedor;
use appComercial\ProveedorContacto;
use appComercial\Cliente;
use appComercial\ClienteNatural;
use appComercial\ClienteJuridico;
use appComercial\CosteoItem;
use appComercial\Colaborador;
use appComercial\CotiCosteo; 
use appComercial\Cotizacion;
use appComercial\Dolar;
use appComercial\Igv;
use appComercial\Custom\MyClass;
use Carbon\Carbon;
use DB;
use Auth;

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
//            $query = trim($request->get('searchText'));
            $cotizaciones = DB::table('tcotizacion as c')
                ->join('tcolaborador as col', 'c.codiCola', '=', 'col.codiCola')
                ->join('tcotizacionestado as ce', 'c.codiCotiEsta', '=', 'ce.codiCotiEsta')
                ->join('tcliente as cli', 'c.codiClien', '=', 'cli.codiClien')
                ->join('tclientenatural as cn', 'cli.codiClienNatu', '=', 'cn.codiClienNatu')
                ->join('tclientejuridico as cj', 'cli.codiClienJuri', '=', 'cj.codiClienJuri')
                ->join('tcoticosteo as cc', 'c.codiCoti', '=', 'cc.codiCoti')
                ->join('tcosteo as cos', 'cc.codiCosteo', '=', 'cos.codiCosteo')
                ->join('tcosteoitem as ci', 'cos.codiCosteo', '=', 'ci.codiCosteo')
                ->join('tprecioproductoproveedor as ppp', 'ci.idTPrecioProductoProveedor', '=', 'ppp.idTPrecioProductoProveedor')
                ->join('tproductoproveedor as pp', 'ppp.codiProducProveedor', '=', 'pp.codiProducProveedor')
                ->select('c.codiCoti', 'c.numCoti','c.codiCola', 'c.asuntoCoti', 'cli.codiClien', 'cn.codiClienNatu', 'cn.apePaterClienN', 'cn.apeMaterClienN', 'cn.nombreClienNatu', 'cj.codiClienJuri', 'cj.razonSocialClienJ', 'ce.nombreCotiEsta','cos.totalVentaSoles','ce.estaCotiEsta', 'pp.nombreProducProveedor', 'c.fechaSistema', 'col.nombreCola', 'col.apePaterCola', 'col.apeMaterCola', 'c.estado', 'ci.itemCosteo', 'ci.costoTotalSolesIgv')
                ->where('c.estado', '=', 1)
                ->where('c.codiCola', '=', Auth::user()->codiCola)
                /*->orwhere('cn.apePaterClienN','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
                ->orwhere('cj.razonSocialClienJ','LIKE','%'.$query.'%')*/
                ->orderBy('c.numCoti', 'desc')
                ->groupBy('c.codiCoti')
                ->paginate(10);

            return view('cotizaciones.index', [
                "cotizaciones" => $cotizaciones
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
//        try {
//            DB::beginTransaction();

            $num_cotis = Cotizacion::all();
        
            $pk = new MyClass();

            $mytime = Carbon::now('America/Lima');

            // registrar cotización

            $cotizacion = new Cotizacion();
            $cotizacion->codiCoti = $pk->pk_generator("COT");
            $cotizacion->fechaCoti = $mytime->toDateTimeString();
            $cotizacion->asuntoCoti = "NUEVA COTIZACION";
            $cotizacion->nomCli = '.';
            $cotizacion->codiClien = '1';
            $cotizacion->nomContac = '';
            $cotizacion->codiContacClien = 1;
            $cotizacion->codiTipoCliente = null;
            $cotizacion->codiCola = $request->get('txt_codiCola');
            $cotizacion->tiemCoti = null;
            $cotizacion->codiCotiEsta = 'CE_23_7_201851310481261271139';
            $cotizacion->estado = 1;
            $cotizacion->numCoti = count($num_cotis) + 1;

            $cotizacion->save();

            //registrar Costeo

            $costeo = new Costeo();
            $costeo->codiCosteo = $pk->pk_generator("COS");
            $costeo->fechaIniCosteo = $mytime->toDateTimeString();
            $costeo->fechaFinCosteo = null;
            $costeo->costoTotalDolares = 0.0;
            $costeo->costoTotalSoles = 0.0;
            $costeo->totalVentaSoles = 0.0;
            $costeo->utilidadVentaSoles = 0.0;
            $costeo->margenCosto = 1.35;
            $costeo->margenVenta = 0.0;
            $costeo->codiCosteoEsta = 'CE_23_7_201851103826117134912';
            $costeo->codiCola = $request->get('txt_codiCola');
            $costeo->codiIgv = null;
            $costeo->codiDolar = null;
            $costeo->tipoCosteo = 0;
            $costeo->currency = 0;
            $costeo->mostrarTotal = 0;

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
            $costeoItem->itemCosteo = '.';
            $costeoItem->descCosteoItem = '.';
            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = 1;
            $costeoItem->precioProducDolar = 0.0;
            $costeoItem->costoUniIgv = 0.0;
            $costeoItem->costoTotalIgv = 0.0;
            $costeoItem->costoUniSolesIgv = 0.0;
            $costeoItem->costoTotalSolesIgv = 0.0;
            $costeoItem->precioUniSoles = 0.0;
            $costeoItem->precioTotal = 0.0;
            $costeoItem->margenCoti = 1.35;
            $costeoItem->utiCoti = 0.0;
            $costeoItem->margenVentaCoti = 1.3;
            $costeoItem->liquidacion = 0.0;
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = 1;
            $costeoItem->codiProveeContac = 'PC_23_7_201897114126182531013';
            $costeoItem->imagen = "";
            $costeoItem->codInterno = "";
            $costeoItem->codProveedor = null;
            $costeoItem->tipoItem = 0;
            $costeoItem->estado = 1;

            $costeoItem->save();

            $CondicionesComerciales = CondicionesComerciales::all();

            foreach ($CondicionesComerciales as $condicion){
                $cotiCondiciones = new CotiCondiciones();
                $cotiCondiciones->codiCondiComer = $condicion->codiCondiComer;
                $cotiCondiciones->codiCoti = $cotizacion->codiCoti;
                $cotiCondiciones->descripcion = $condicion->descripCondiComer;
                $cotiCondiciones->estado = "1";

                $cotiCondiciones->save();
            }

//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollback();
//        }
//        $proveedores = Proveedor::all();
//        $proveedoresContacto = ProveedorContacto::all();
//        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
//        $tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('estadoTipoCliJur','=','1')->get();
//        $dolar = Dolar::all();
//        $igv = Igv::all();
//        $productos = ProductoProveedor::all();
//        $clientes = DB::table('tcliente as c')
//        ->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
//        ->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
//        ->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
//        ->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
//        ->where('c.estado','=',1)
//            ->get();
//        // return view("cotizaciones.create", ["clientes" => $clientes, "tipoClientes"=> $tipoClientes])->with('cotizacion',$cotizacion->codiCoti);
//        $condicionesCom = CotiCondiciones::where('codiCoti',$cotizacion->codiCoti)->get();
//
//        return view("cotizaciones.create", [
//            "condicionesCom" => $condicionesCom,
//            "costeo" => $costeo,
//            "dataCotizacion" => $cotizacion,
//            "condicionesCom" => $condicionesCom,
//            "productos" => $productos,
//            "tipoClientesJuridicos"=>$tipoClienteJuridico,
//            "proveedores"=>$proveedores,
//            "proveedoresContacto"=>$proveedoresContacto,
//            "clientes" => $clientes,
//            "tipoClientes"=> $tipoClientes
//        ])
//        //->with('costeo_item',$costeoItem->codiCosteo)
//        ->with('cotizacion',$cotizacion->codiCoti)
//        //->with('costeo',$costeo->codiCosteo)
//        ->with('dolar',$dolar->last())
//        ->with('igv',$igv->last());

        return Redirect::to('cotizaciones');
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
        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($request->get('txt_codiCoti'));
        $cotizacion->asuntoCoti = strtoupper($request->get('txt_asuntoCoti'));
        $cotizacion->nomCli = strtoupper($request->get('txt_cliente'));
        if ($request->get('txt_cliente_ruc_dni') != ''){
            $cotizacion->codiClien = $request->get('txt_codiClien');
        }else{
            $cotizacion->codiClien = 1;
        }

        if($request->get('txt_atencion_ruc_dni') != ''){
            $cotizacion->codiContacClien = $request->get('txt_codiContacClien');
        }else{
            $cotizacion->codiContacClien = 1;
        }
        $cotizacion->nomContac = $request->get('txt_atencion');
        $cotizacion->codiTipoCliente = null;
//        $cotizacion->codiCola = $request->get('txt_codiCola');
        $cotizacion->tiemCoti = null;
        if (isset($request['btn_pre'])) {//PRE COTIZACION
            $cotizacion->codiCotiEsta = 'CE_23_7_201851310481261271139';//en desarrollo
        }else if(isset($request['btn_coti'])){
            $cotizacion->codiCotiEsta = 'CE_24_7_201837135210641218119';//finalizado
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
            $costeo->codiCosteoEsta = 'CE_23_7_201851103826117134912';//iniciado
        }else if(isset($request['btn_coti'])){
            $costeo->codiCosteoEsta = 'CE_23_7_201811152124783691013';//finalizado
        }
        $costeo->codiCola = $request->get('txt_codiCola');
        $costeo->codiIgv = $request->get('txt_igv');
        $costeo->codiDolar = $request->get('txt_dolar');
        $costeo->tipoCosteo = $request->get('cb_option');
        $costeo->currency = $request->get('cmb_currency');
        if ($request->get('cb_ver_total') == 1) {
            $costeo->mostrarTotal = 1;
        }else{
            $costeo->mostrarTotal = 0;
        }
        $costeo->update();

        $costeoItems = CosteoItem::where('codiCosteo',$request->get('txt_codiCosteo'))->get();

        $i = 1;

        foreach ($costeoItems as $costeoItem){

            $txt_producto = 'txt_producto'.$i;
            $txt_new_product = 'txt_new_product'.$i;
            $txt_descripcion = 'txt_descripcion'.$i;
            $txt_cantidad = 'txt_cantidad'.$i;
            $txt_cus_dolar_sin = 'txt_cus_dolar_sin'.$i;
            $txt_cus_dolar = 'txt_cus_dolar'.$i;
            $txt_total_dolar = 'txt_total_dolar'.$i;
            $txt_cus_soles = 'txt_cus_soles'.$i;
            $txt_total_soles = 'txt_total_soles'.$i;
            $txt_pu_soles = 'txt_pu_soles'.$i;
            $txt_pu_total_soles = 'txt_pu_total_soles'.$i;
            $txt_margen_cu_soles = 'txt_margen_cu_soles'.$i;
            $txt_utilidad_u = 'txt_utilidad_u'.$i;
            $txt_margen_u = 'txt_margen_u'.$i;

            $txt_cod_interno = 'txt_cod_interno'.$i;
            $txt_cod_proveedor = 'txt_cod_proveedor'.$i;

            $txt_imagen = 'txt_imagen'.$i;

            $costeoItem = CosteoItem::findOrFail($costeoItem->idCosteoItem);
            $costeoItem->codiCosteo = $request->get('txt_codiCosteo');
            $costeoItem->idTPrecioProductoProveedor = 1;
            if ($request->get($txt_new_product) != ""){ //si NO esta vacio el campo nuevo_producto
                $costeoItem->itemCosteo = strtoupper($request->get($txt_new_product));
            }else{
                $costeoItem->itemCosteo = '.';
            }
            $costeoItem->descCosteoItem = $request->get($txt_descripcion);
            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = $request->get($txt_cantidad);
            $costeoItem->precioProducDolar = $request->get($txt_cus_dolar_sin);
            $costeoItem->costoUniIgv = $request->get($txt_cus_dolar);
            $costeoItem->costoTotalIgv = $request->get($txt_total_dolar);
            $costeoItem->costoUniSolesIgv = $request->get($txt_cus_soles);
            $costeoItem->costoTotalSolesIgv = $request->get($txt_total_soles);
            $costeoItem->precioUniSoles = $request->get($txt_pu_soles);
            $costeoItem->precioTotal = $request->get($txt_pu_total_soles);
            $costeoItem->margenCoti = $request->get($txt_margen_cu_soles);
            $costeoItem->utiCoti = $request->get($txt_utilidad_u);
            $costeoItem->margenVentaCoti = $request->get($txt_margen_u);
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = $i;
            $costeoItem->codiProveeContac = null;
//            if (Input::hasFile($txt_imagen)) {
//                $file =  Input::file($txt_imagen);
//                $file->move(public_path().'/imagenes/productos/',$file->getClientOriginalName());
//                $costeoItem->imagen = $file->getClientOriginalName();
//            }else{
//                $costeoItem->imagen = "default.jpg";
//            }
            $costeoItem->imagen = $request->get($txt_imagen);
            $costeoItem->codInterno = $request->get($txt_cod_interno);
            $costeoItem->codProveedor = $request->get($txt_cod_proveedor);
            $costeoItem->tipoItem = $request->get('cb_option');

            $costeoItem->estado = 1;

            $costeoItem->update();

            $i++;
        }

        $old_cotiCondiciones = CotiCondiciones::where('codiCoti', $cotizacion->codiCoti)->get();
        foreach ($old_cotiCondiciones as $old_cotiCondicion) {
            $cotiCondi = CotiCondiciones::findOrFail($old_cotiCondicion->idTCotiCondiciones);
            $cotiCondi->descripcion = $request->get("txt_".$old_cotiCondicion->idTCotiCondiciones);
            $cotiCondi->update();
//            echo $old_cotiCondicion->idTCotiCondiciones." ".$old_cotiCondicion->descripcion."<br>";
//            echo $request->get("txt_".$old_cotiCondicion->idTCotiCondiciones)."<br>";
        }

        if (isset($request['btn_pre'])) {//PRE COTIZACION
            return redirect()->action('CotizacionController@continuar', ['codiCoti'=>$cotizacion->codiCoti]);
        }else{
            return Redirect::to('cotizaciones');
        }

    }

    //solo actualizar el costeo en la vista tipo tabla
    public function updateCosteo(Request $request, $codiCoti){
        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($codiCoti)->first();

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeoItems = CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        $numCosteos = count(CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->get());

        $i = 1;

        foreach ($costeoItems as $costeoItem){

//            $txt_producto = 'txt_producto'.$i;
            $txt_new_product = 'txt_new_product'.$i;
//            $txt_descripcion = 'txt_descripcion'.$i;
            $txt_cantidad = 'txt_cantidad'.$i;
            $txt_cus_dolar_sin = 'txt_cus_dolar_sin'.$i;
            $txt_cus_dolar = 'txt_cus_dolar'.$i;
            $txt_total_dolar = 'txt_total_dolar'.$i;
            $txt_cus_soles = 'txt_cus_soles'.$i;
            $txt_total_soles = 'txt_total_soles'.$i;
            $txt_pu_soles = 'txt_pu_soles'.$i;
            $txt_pu_total_soles = 'txt_pu_total_soles'.$i;
            $txt_margen_cu_soles = 'txt_margen_cu_soles'.$i;
            $txt_utilidad_u = 'txt_utilidad_u'.$i;
            $txt_margen_u = 'txt_margen_u'.$i;

//            $txt_cod_interno = 'txt_cod_interno'.$i;
//            $txt_cod_proveedor = 'txt_cod_proveedor'.$i;
//
//            $txt_imagen = 'txt_imagen'.$i;

            $costeoItem = CosteoItem::findOrFail($costeoItem->idCosteoItem);
//            $costeoItem->codiCosteo = $request->get('txt_codiCosteo');
            $costeoItem->idTPrecioProductoProveedor = 1;
            if ($request->get($txt_new_product) != ""){ //si NO esta vacio el campo nuevo_producto
                $costeoItem->itemCosteo = strtoupper($request->get($txt_new_product));
            }else{
                $costeoItem->itemCosteo = '.';
            }
//            $costeoItem->descCosteoItem = $request->get($txt_descripcion);
//            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = $request->get($txt_cantidad);
            $costeoItem->precioProducDolar = $request->get($txt_cus_dolar_sin);
            $costeoItem->costoUniIgv = $request->get($txt_cus_dolar);
            $costeoItem->costoTotalIgv = $request->get($txt_total_dolar);
            $costeoItem->costoUniSolesIgv = $request->get($txt_cus_soles);
            $costeoItem->costoTotalSolesIgv = $request->get($txt_total_soles);
            $costeoItem->precioUniSoles = $request->get($txt_pu_soles);
            $costeoItem->precioTotal = $request->get($txt_pu_total_soles);
            $costeoItem->margenCoti = $request->get($txt_margen_cu_soles);
            $costeoItem->utiCoti = $request->get($txt_utilidad_u);
            $costeoItem->margenVentaCoti = $request->get($txt_margen_u);
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = $i;
            $costeoItem->codiProveeContac = null;
//            $costeoItem->imagen = $request->get($txt_imagen);
//            $costeoItem->codInterno = $request->get($txt_cod_interno);
//            $costeoItem->codProveedor = $request->get($txt_cod_proveedor);
//            $costeoItem->tipoItem = $request->get('cb_option');

            $costeoItem->estado = 1;

            $costeoItem->update();

            $i++;
        }

        return Redirect::to('cotizaciones.index');
    }

    public function destroy($codiClienteJuridico)
    {
        $cotiCosteo = CotiCosteo::findOrFail('COS_25_5_201823112611910758413');
        $cotiCosteo->estadoSedeJur = 0;
        $cotiCosteo->update();
        return Redirect::to('cotizaciones');
    }

    public function verCoti(){
//        $colaboradores = DB::table('tcolaborador')
//            ->where('estado', '=', '1')
//            ->where('')
//            ->get();
        $colaboradores = User::all();
        return view('cotizaciones.cotiCola',["colaboradores"=>$colaboradores]);
    }

    public function detalleCoti($codiCola){
        $colaborador = Colaborador::findOrFail($codiCola);
        return view('cotizaciones.detalleCoti',["colaborador"=>$colaborador]);
    }

    public function continuar(Request $request, $codiCoti){
        //devolver todos los datos necesarios para cargar la vista de "Nueva cotizacion"
        $coti_continue = Cotizacion::findOrFail($codiCoti);

        $cli = Cliente::where('codiClien', $coti_continue->codiClien)->first();

        /*$cliente_continue = DB::table('tcliente')->where('codiClien', '=', $coti_continue->codiClien)->get();//el metodo DB no devuelve un objeto se debe deserializar para acceder a los campos como un array
        //verificar si es cliente juridico o natural
        $cli = [];
        foreach ($cliente_continue as $cliente)
        {
            $cli = $cliente;
        }*/

        if ($cli->codiClienJuri == 1) { //si es 1 entonces es cliente natural
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
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ppp.idTPrecioProductoProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.codInterno','ci.codProveedor','ci.imagen','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv','ci.numPack' ,'ci.precioUniSoles','ci.precioTotal','ci.margenCoti', 'ci.margenVentaCoti')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();//se envia este arreglo a la vista

        $cItem = CosteoItem::where('codiCosteo',$cotiCosteo->codiCosteo)->firstOrFail();

        $proveedores = Proveedor::all();

        //$proveedoresContacto = ProveedorContacto::all();

        $contactoCliente = ContactoCliente::where('codiContacClien',$coti_continue->codiContacClien)->first();

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

        $condicionesCom = CotiCondiciones::where('codiCoti',$coti_continue->codiCoti)->get();

        return view('cotizaciones.create',[
            "productos"=>$productos,
            "tipoClientesJuridicos"=>$tipoClienteJuridico,
            "contactoCliente"=>$contactoCliente,
            "proveedores"=>$proveedores,
            "cItem"=>$cItem,
            "costeosItems"=>$costeosItems,
            "coti_continue"=>$coti_continue,
            "clientes"=>$clientes,
            "_cliente"=>$_cliente,
            "tipoClientes"=>$tipoClientes,
            "costeo"=>$costeo,
            "condicionesCom"=>$condicionesCom,
            "dolar"=>$dolar->last(),
            "igv"=>$igv->last()
        ])
        ->with("cotizacion",$coti_continue->codiCoti);
    }

    public function reutilizar(Request $request)
    {
        //cargar datos de cotizacion a reutilizar

        $old_cotizacion = Cotizacion::findOrFail($request->get('txt_codiCoti'));//(ok)
        $num_cotis = Cotizacion::all(); //para obtener el numero total de cotizaciones

        $old_cotiCosteo = CotiCosteo::where('codiCoti',$old_cotizacion->codiCoti)->first();//(ok)

        $old_costeo = Costeo::where('codiCosteo', $old_cotiCosteo->codiCosteo)->first();

        $old_condiciones = CotiCondiciones::where('codiCoti',$old_cotizacion->codiCoti)->get();

        $pk = new MyClass();

        $mytime = Carbon::now('America/Lima');

        //registrar cotizacion nueva con data a reutilizar

        $cotizacion = new Cotizacion();
        $cotizacion->codiCoti = $pk->pk_generator("COT");
        $cotizacion->fechaCoti = $mytime->toDateTimeString();
        $cotizacion->asuntoCoti = $old_cotizacion->asuntoCoti;
        $cotizacion->nomCli = $old_cotizacion->nomCli;
        $cotizacion->codiClien = $old_cotizacion->codiClien;
        $cotizacion->nomContac = $old_cotizacion->nomContac;
        $cotizacion->codiContacClien = $old_cotizacion->codiContacClien;
        $cotizacion->codiTipoCliente = $old_cotizacion->codiTipoCliente;
        $cotizacion->codiCola = $request->get('txt_codiCola');
        $cotizacion->tiemCoti = $old_cotizacion->tiemCoti;
        $cotizacion->codiCotiEsta = 'CE_23_7_201851310481261271139';//en construccion

        $cotizacion->estado = 1;
        $cotizacion->numCoti = count($num_cotis) + 1;

        $cotizacion->save();

        //registrar Costeo

        $costeo = new Costeo();
        $costeo->codiCosteo = $pk->pk_generator("COS");
        $costeo->fechaIniCosteo = $mytime->toDateTimeString();
        $costeo->fechaFinCosteo = null;
        $costeo->costoTotalDolares = $old_costeo->costoTotalDolares;
        $costeo->costoTotalSoles = $old_costeo->costoTotalSoles;
        $costeo->totalVentaSoles = $old_costeo->totalVentaSoles;
        $costeo->utilidadVentaSoles = $old_costeo->utilidadVentaSoles;
        $costeo->margenCosto = $old_costeo->margenCosto;
        $costeo->margenVenta = $old_costeo->margenVenta;
        $costeo->codiCosteoEsta = 'CE_23_7_201851103826117134912';//iniciado
        $costeo->codiCola = $request->get('txt_codiCola');
        $costeo->codiIgv = $old_costeo->codiIgv;
        $costeo->codiDolar = $old_costeo->codiDolar;
        $costeo->tipoCosteo = $old_costeo->tipoCosteo;
        $costeo->mostrarTotal = 1;

        $costeo->save();

        //registrar cotiCosteo

        $cotiCosteo = new CotiCosteo();
        $cotiCosteo->codiCosteo = $costeo->codiCosteo;
        $cotiCosteo->codiCoti = $cotizacion->codiCoti;
        $cotiCosteo->codiCola = $request->get('txt_codiCola');
        $cotiCosteo->estado = 1;

        $cotiCosteo->save();

        $costeoItems = CosteoItem::where('codiCosteo',$old_costeo->codiCosteo)->get();

        $i = 1;

        foreach ($costeoItems as $old_costeoItem){

            $costeoItem = new CosteoItem();
            $costeoItem->codiCosteo = $costeo->codiCosteo;
            $costeoItem->idTPrecioProductoProveedor = $old_costeoItem->idTPrecioProductoProveedor;
            $costeoItem->itemCosteo = $old_costeoItem->itemCosteo;
            $costeoItem->descCosteoItem = $old_costeoItem->descCosteoItem;
            $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            $costeoItem->cantiCoti = $old_costeoItem->cantiCoti;
            $costeoItem->precioProducDolar = $old_costeoItem->precioProducDolar;
            $costeoItem->costoUniIgv = $old_costeoItem->costoUniIgv;
            $costeoItem->costoTotalIgv = $old_costeoItem->costoTotalIgv;
            $costeoItem->costoUniSolesIgv = $old_costeoItem->costoUniSolesIgv;
            $costeoItem->costoTotalSolesIgv = $old_costeoItem->costoTotalSolesIgv;
            $costeoItem->precioUniSoles = $old_costeoItem->precioUniSoles;
            $costeoItem->precioTotal = $old_costeoItem->precioTotal;
            $costeoItem->margenCoti = $old_costeoItem->margenCoti;
            $costeoItem->utiCoti = $old_costeoItem->utiCoti;
            $costeoItem->margenVentaCoti = $old_costeoItem->margenVentaCoti;
            $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            $costeoItem->numPack = $i;
            $costeoItem->codiProveeContac = $old_costeoItem->codiProveeContac;
            $costeoItem->imagen = $old_costeoItem->imagen;
            $costeoItem->codInterno = $old_costeoItem->codInterno;
            $costeoItem->codProveedor = $old_costeoItem->codProveedor;
            $costeoItem->tipoItem = $old_costeoItem->tipoItem;

            $costeoItem->estado = 1;

            $costeoItem->save();

            $i++;
        }

        foreach ($old_condiciones as $old_condicion){
            $cotiCondiciones = new CotiCondiciones();
            $cotiCondiciones->codiCondiComer = $old_condicion->codiCondiComer;
            $cotiCondiciones->codiCoti = $cotizacion->codiCoti;
            $cotiCondiciones->descripcion = $old_condicion->descripcion;
            $cotiCondiciones->estado = "1";

            $cotiCondiciones->save();
        }
        return Redirect::to('cotizaciones');
    }

    public function find_by_params(Request $request)
    {

        if ($request->get('txt_find_producto') != "") {
            $campo = 'ci.itemCosteo';
            $valor = $request->get('txt_find_producto');
        } else if ($request->get('txt_find_codiCoti') != "") {
            $campo = 'c.numCoti';
            $valor = $request->get('txt_find_codiCoti');
        } else if ($request->get('txt_find_asunto') != "") {
            $campo = 'c.asuntoCoti';
            $valor = $request->get('txt_find_asunto');
        } else if ($request->get('txt_find_cliente') != "") {
            $campo = 'cj.razonSocialClienJ';
            $valor = $request->get('txt_find_cliente');
        }

        $cotizaciones = DB::table('tcotizacion as c')
            ->join('tcolaborador as col', 'c.codiCola', '=', 'col.codiCola')
            ->join('tcotizacionestado as ce', 'c.codiCotiEsta', '=', 'ce.codiCotiEsta')
            ->join('tcliente as cli', 'c.codiClien', '=', 'cli.codiClien')
            ->join('tclientenatural as cn', 'cli.codiClienNatu', '=', 'cn.codiClienNatu')
            ->join('tclientejuridico as cj', 'cli.codiClienJuri', '=', 'cj.codiClienJuri')
            ->join('tcoticosteo as cc', 'c.codiCoti', '=', 'cc.codiCoti')
            ->join('tcosteo as cos', 'cc.codiCosteo', '=', 'cos.codiCosteo')
            ->join('tcosteoitem as ci', 'cos.codiCosteo', '=', 'ci.codiCosteo')
            ->join('tprecioproductoproveedor as ppp', 'ci.idTPrecioProductoProveedor', '=', 'ppp.idTPrecioProductoProveedor')
            ->join('tproductoproveedor as pp', 'ppp.codiProducProveedor', '=', 'pp.codiProducProveedor')
            ->select('c.codiCoti', 'c.numCoti', 'c.codiCola', 'c.asuntoCoti', 'cli.codiClien', 'cn.codiClienNatu', 'cn.apePaterClienN', 'cn.apeMaterClienN', 'cn.nombreClienNatu', 'cj.codiClienJuri', 'cj.razonSocialClienJ', 'ce.nombreCotiEsta', 'cos.totalVentaSoles', 'ce.estaCotiEsta', 'pp.nombreProducProveedor', 'c.fechaSistema', 'col.nombreCola', 'col.apePaterCola', 'col.apeMaterCola', 'c.estado', 'ci.itemCosteo', 'ci.costoTotalSolesIgv')//campos a mostrar de la unión
            // ->select('c.codiCoti','c.asuntoCoti','c.fechaSistema')//campos a mostrar de la unión            
            ->where($campo, 'LIKE', '%' . $valor . '%')
            ->where('c.estado', '=', 1)
            ->orderBy('c.fechaSistema', 'desc')
            ->groupBy('c.codiCoti')
            ->paginate(10);

        return view('cotizaciones.index', [
            "cotizaciones" => $cotizaciones
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

        $colaborador = Colaborador::findOrFail($cotizacion->codiCola);

        $contrato = Contrato::where('codiCola',$cotizacion->codiCola)->first();

        $cargo = Cargo::where('codiCargo',$contrato->codiCargo)->first();

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = Costeo::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        // $costeoItem = CosteoItem::where('codiCosteo', $costeo->codiCosteo)->get();

        $productos = DB::table('tcosteoitem as ci')
        ->join('tprecioproductoproveedor as ppp','ppp.idTPrecioProductoProveedor','=','ci.idTPrecioProductoProveedor')
        ->join('tproductoproveedor as pp','pp.codiProducProveedor','=','ppp.codiProducProveedor')
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.precioUniSoles', 'ci.precioTotal','ci.margenCoti', 'ci.numPack','ci.imagen')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)
        ->where('ci.estado', '=', 1)->get();

        $cliente = Cliente::where('codiClien', $cotizacion->codiClien)->first();
        
        //verificar si es cliente juridico o natural
        if ($cliente->codiClienJuri == '001') { //si es 001 entonces es cliente natural
            $_cliente = ClienteNatural::findOrFail($cliente->codiClienNatu);
        }else{//sino es un cliente juridico
            $_cliente = ClienteJuridico::findOrFail($cliente->codiClienJuri);
            $contactoCliente = ContactoCliente::where('codiClienJuri',$_cliente->codiClienJuri)->first();
        }

        $condicionesCom = CotiCondiciones::where('codiCoti',$cotizacion->codiCoti)->get();

        $view = View::make('cotizaciones.pdfCoti',compact('_cliente','cotizacion', 'cargo','colaborador','contrato','contactoCliente', 'condicionesCom', 'productos', 'costeo'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('cotizacion'.'.pdf');
    }

    // public function addCosteoItem($codiCoti){
    public function addCosteoItem(Request $request){

        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($request->get('codiCoti'));

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        $numCosteos = count(CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->get());

        // return "Pack n°: ".$costeo->numPack;

        $costeoItem = new CosteoItem();

        $costeoItem->codiCosteo = $costeo->codiCosteo;
        $costeoItem->idTPrecioProductoProveedor = 1;
        $costeoItem->itemCosteo = '.';
        $costeoItem->descCosteoItem = "";
        $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
        $costeoItem->cantiCoti = 1;
        $costeoItem->precioProducDolar = 0.0;
        $costeoItem->costoUniIgv = 0.0;
        $costeoItem->costoTotalIgv = 0.0;
        $costeoItem->costoUniSolesIgv = 0.0;
        $costeoItem->costoTotalSolesIgv = 0.0;
        $costeoItem->precioUniSoles = 0.0;
        $costeoItem->precioTotal = 0.0;
        $costeoItem->margenCoti = 1.3;
        $costeoItem->utiCoti = 0.0;
        $costeoItem->margenVentaCoti = 0.0;
        $costeoItem->liquidacion = 0.0;
        $costeoItem->fechaCosteoActu = null;
        $costeoItem->numPack = $numCosteos + 1;
        $costeoItem->codiProveeContac = null;
        $costeoItem->imagen = "default.jpg";
        $costeoItem->codInterno = "";
        $costeoItem->codProveedor = "";
        $costeoItem->tipoItem = 0;//prod o servicio
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
        ->select('ci.idCosteoItem','ci.itemCosteo','pp.nombreProducProveedor','ci.descCosteoItem','ci.cantiCoti','ci.precioProducDolar','ci.costoUniIgv','ci.costoTotalIgv','ci.costoUniSolesIgv','ci.costoTotalSolesIgv', 'ci.margenCoti', 'ci.margenVentaCoti','ci.utiCoti','ci.numPack', 'ci.precioUniSoles', 'ci.precioTotal')
        ->where('ci.codiCosteo', '=', $costeo->codiCosteo)->get();

        return view('cotizaciones.vistaCoti', compact('productos', 'cotizacion', 'costeo'));
    }

    public function buscarCliente(Request $request){
        $query = trim($request->get('searchText'));
        $clientes = DB::table('tcliente as c')
            ->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
            ->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
            ->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
            ->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
            ->where('cn.apePaterClienN','LIKE','%'.$query.'%')
            ->where('c.estado','=',1)
            ->orwhere('cj.razonSocialClienJ','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
            ->orwhere('cj.rucClienJuri','LIKE','%'.$query.'%')
            ->orderBy('c.codiClien','desc')
            ->paginate(15);

        $tipoClientesJuridicos = TipoClienteJuridico::all();

        return view('cotizaciones.buscarCliente',["clientes"=>$clientes,"tipoClientesJuridicos"=>$tipoClientesJuridicos,"searchText"=>$query]);
    }

    public function prueba(Request $request){
        echo "RESPUESTA: " . $request->get('cb_ver_total');
    }

    public function estadisticas(Request $request){
        $totalCotizaciones = count(Cotizacion::all());
        return $totalCotizaciones;
    }
    
}
