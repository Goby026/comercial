<?php

namespace appComercial\Http\Controllers;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use appComercial\Http\Requests\CotizacionFormRequest;
use appComercial\Http\Requests\ClienteJuridicoFormRequest;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Costeo;
use appComercial\CosteoItem;
use appComercial\TipoCliente;
use appComercial\Colaborador;
use appComercial\CotiCosteo; 
use appComercial\Cotizacion;
use appComercial\Custom\MyClass;
use Carbon\Carbon;
use DB;

class CotizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // if ($request) {
        //     $query = trim($request->get('searchText'));
        //     $cotizaciones = DB::table('tcotizacion as c')
        //        ->join('tcotizacionestado as ce','sj.codiClienJuri','=','cj.codiClienJuri')
        //        ->join('tcolaborador as col','sj.codiClienJuri','=','cj.codiClienJuri')
        //        ->join('tcliente as cli','sj.codiClienJuri','=','cj.codiClienJuri')
        //     ->join('tclientejuridico as cj','sj.codiClienJuri','=','cj.codiClienJuri')
        //     ->select('sj.codiSedeJur','sj.descSedeJur','sj.estadoSedeJur','sj.fechaSistema','cj.razonSocialClienJ as Cliente')//campos a mostrar de la unión
        //     ->where('sj.descSedeJur','LIKE','%'.$query.'%')
        //     ->where('sj.estadoSedeJur','=',1)
        //     ->orwhere('sj.codiSedeJur','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
        //     ->orderBy('sj.codiSedeJur','desc')
        //     ->paginate(5);
        //     return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
        // }
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        return view('cotizaciones.index', ["clientes" => $clientes]);
    }

    public function create()
    {
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        return view("cotizaciones.create", ["clientes" => $clientes, "tipoClientes" => $tipoClientes]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CotizacionFormRequest $request)
    {
       

            $cotizacion = new Cotizacion();
            $pk = new MyClass();

            $mytime = Carbon::now('America/Lima');

            // registrar cotizacion

            $cotizacion->codiCoti = $pk->pk_generator("COT");
            $cotizacion->fechaCoti = $mytime->toDateTimeString();
            $cotizacion->asuntoCoti = 'Some thing';
            $cotizacion->codiClien = 2;
            $cotizacion->codiTipoCliente = 'TC_3_5_201869111138534101227';
            $cotizacion->codiCola = '45068903';
            $cotizacion->tiemCoti = null;
            $cotizacion->codiCotiEsta = 'CE_10_5_201891310112387125416';
            $cotizacion->estado = 1;

            $cotizacion->save();

            //registrar Costeo
            // $costeo = new Costeo();
            // $costeo->codiCosteo = $pk->pk_generator("COS");
            // $costeo->fechaIniCosteo = $mytime->toDateTimeString();
            // $costeo->fechaFinCosteo = null;
            // $costeo->costoTotalDolares = null;
            // $costeo->costoTotalSoles = null;
            // $costeo->totalVentaSoles = null;
            // $costeo->utilidadVentaSoles = null;
            // $costeo->margenCosto = null;
            // $costeo->margenVenta = null;
            // $costeo->codiCosteoEsta = null;
            // $costeo->codiCola = null;
            // $costeo->codiIgv = null;
            // $costeo->codiDolar = null;

            // $costeo->save();

            //registrar CotiCosteo

            // $cotiCosteo = new CotiCosteo();
            // $cotiCosteo->codiCosteo = $costeo->codiCosteo;
            // $cotiCosteo->codiCoti = $cotizacion->codiCoti;
            // $cotiCosteo->codiCola = '45068903';
            // $cotiCosteo->estado = 1;

            // $cotiCosteo->save();

            //registrar CosteoItem
            // $costeoItem = new CosteoItem();
            // $costeoItem->codiCosteo = $costeo->codiCosteo;
            // $costeoItem->itemCosteo = 'Some product';
            // $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
            // $costeoItem->codiProveedor = 'p001';
            // $costeoItem->codiProducProveedor = 'PP_15_5_201887641159121013123'; //debe ser el CODIGO DE PRODUCTO-PROVEEDOR
            // $costeoItem->cantiCoti = 1;
            // $costeoItem->precioProducDolar = 0.0;
            // $costeoItem->costoUniIgv = 0.0;
            // $costeoItem->costoTotalIgv = 0.0;
            // $costeoItem->costoUniSolesIgv = 0.0;
            // $costeoItem->costoTotalSolesIgv = 0.0;
            // $costeoItem->margenCoti = 0.01;
            // $costeoItem->utiCoti = 0.3;
            // $costeoItem->margenVentaCoti = 0.03;
            // $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
            // $costeoItem->numPack = 1;
            // $costeoItem->codiProveeContac = 'pc001';
            // $costeoItem->estado = 1;

            // $costeoItem->save();
            
        
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        return view("cotizaciones.create", ["clientes" => $clientes, "tipoClientes"=> $tipoClientes])->with('cotizacion',$cotizacion->codiCoti);
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

    public function update(SedeJuridicoFormRequest $request, $codiSedeJuridico)
    {
        $SedeJuridico = SedeJuridico::findOrFail($codiSedeJuridico);

        $SedeJuridico->descSedeJur = $request->get('txt_descSedeJur');
        $SedeJuridico->estadoSedeJur = 1;
        $SedeJuridico->codiClienJuri = $request->get('txt_codiClienJuri');
        $SedeJuridico->update();

        return Redirect::to('cotizaciones');
    }

    public function destroy($codiClienteJuridico)
    {
        $SedeJuridico = SedeJuridico::findOrFail($codiClienteJuridico);
        $SedeJuridico->estadoSedeJur = 0;
        $SedeJuridico->update();
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

    
}
