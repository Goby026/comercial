<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Cotizacion;//hacemos referencia al modelo
use appComercial\Http\Requests\CotizacionFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CotizacionController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	// if ($request) {
    	// 	$query = trim($request->get('searchText'));
    	// 	$cotizaciones = DB::table('tcotizacion as c')
     //        ->join('tcotizacionestado as ce','sj.codiClienJuri','=','cj.codiClienJuri')
     //        ->join('tcolaborador as col','sj.codiClienJuri','=','cj.codiClienJuri')
     //        ->join('tcliente as cli','sj.codiClienJuri','=','cj.codiClienJuri')
    	// 	->join('tclientejuridico as cj','sj.codiClienJuri','=','cj.codiClienJuri')
    	// 	->select('sj.codiSedeJur','sj.descSedeJur','sj.estadoSedeJur','sj.fechaSistema','cj.razonSocialClienJ as Cliente')//campos a mostrar de la unión
    	// 	->where('sj.descSedeJur','LIKE','%'.$query.'%')
     //     ->where('sj.estadoSedeJur','=',1)
    	// 	->orwhere('sj.codiSedeJur','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    	// 	->orderBy('sj.codiSedeJur','desc')
    	// 	->paginate(5);
    	// 	return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
    	// }
        $clientes = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS        
    	return view('cotizaciones.index',["clientes"=>$clientes]);
    }

    public function create(){
    	$clientesJuridico = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
    	return view("cotizaciones.create",["clientesJuridico"=>$clientesJuridico]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CotizacionFormRequest $request){
    	$cotizacion = new Cotizacion();
        $pk = new MyClass();

        $hoy = getdate();
        $fecha = $hoy['mday']."-".$hoy['mon']."-".$hoy['year'];

        // registrar cotizacion

    	$cotizacion->codiCoti = $pk->pk_generator("COT");
    	$cotizacion->fechaCoti = $fecha;
        $cotizacion->asuntoCoti = NULL;
        $cotizacion->codiClien = NULL;
        $cotizacion->codiTipoCliente = NULL;
        $cotizacion->codiCola = NULL;
        $cotizacion->tiemCoti = NULL;
        $cotizacion->codiCotiEsta = NULL;
        $cotizacion->estado = 1;

    	$cotizacion->save();

        //registrar CotiCosteo

        //registrar Costeo

        //registrar CosteoItem

    	// return Redirect::to('',["var"=>'codiCoti']);
        $clientes = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS        
        return view("cotizaciones.index",["var"=>'codiCoti',"clientes"=>$clientes]);
    }

    public function show($codiSedeJuridico){
    	return view('cotizaciones.show',["SedesJuridico"=>SedeJuridico::findOrFail($codiSedeJuridico)]);
    }

    public function edit($codiSedeJuridico){
    	$SedeJuridico =SedeJuridico::findOrFail($codiSedeJuridico);
    	$clientesJuridico = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
    	//print_r($clientesJuridico);
    	return view('cotizaciones.edit',["SedeJuridico"=>$SedeJuridico, "clientesJuridico"=>$clientesJuridico]);
    }

    public function update(SedeJuridicoFormRequest $request,$codiSedeJuridico){
    	$SedeJuridico = SedeJuridico::findOrFail($codiSedeJuridico);

    	$SedeJuridico->descSedeJur = $request->get('txt_descSedeJur');
    	$SedeJuridico->estadoSedeJur = 1;
    	$SedeJuridico->codiClienJuri = $request->get('txt_codiClienJuri');
    	$SedeJuridico->update();

    	return Redirect::to('cotizaciones');
    }

    public function destroy($codiClienteJuridico){
    	$SedeJuridico = SedeJuridico::findOrFail($codiClienteJuridico);
    	$SedeJuridico->estadoSedeJur = 0;
    	$SedeJuridico->update();
    	return Redirect::to('cotizaciones');
    }
}
