<?php

namespace appComercial\Http\Controllers;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use appComercial\Http\Requests\CotizacionFormRequest;
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
        //ID Asunto  Cliente    Producto    Fecha   Creado por  Estado  Total   Acción 
        if ($request) {
            $query = trim($request->get('searchText'));
            $cotizaciones = DB::table('tcotizacion as c')
            ->join('tcotizacionestado as ce','c.codiCotiEsta','=','ce.codiCotiEsta')
            // ->select('c.codiCoti','c.asuntoCoti','cli.codiClien','cn.apePaterClienN','cn.apeMaterClienN','cn.nombreClienNatu','cj.razonSocialClienJ','pp.nombreProducProveedor','c.fechaSistema','col.nombreCola','col.apePaterCola','col.apeMaterCola','c.estado','cc.costoTotalSolesIgv')//campos a mostrar de la unión
            ->select('c.codiCoti','c.asuntoCoti','c.fechaSistema')//campos a mostrar de la unión
            ->where('c.codiCotiEsta','LIKE','%'.$query.'%')
            ->where('c.estado','=',1)
            ->orwhere('c.asuntoCoti','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
            ->orderBy('c.fechaSistema','desc')
            ->paginate(5);
            return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get(); //obtener los clientes jur. ACTIVOS
        return view("cotizaciones.create", ["clientes" => $clientes, "tipoClientes" => $tipoClientes]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $cotizacion = new Cotizacion();
            $pk = new MyClass();

            $mytime = Carbon::now('America/Lima');

            // registrar cotizacion

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
        $tipoClientes = DB::table('ttipocliente')->where('estaTipoCliente', '=', '1')->get();
        $clientes = DB::table('tcliente as c')
        ->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
        ->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
        ->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
        ->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
        ->where('c.estado','=',1)->get();
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

    public function update(Request $request)
    {
        $costeoItem = CosteoItem::findOrFail('COS_25_5_201823112611910758413');
        echo "La fecha es: ".$costeoItem->fechaCosteoIni;
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

    
}
