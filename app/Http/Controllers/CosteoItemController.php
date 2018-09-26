<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\CosteoItem;//hacemos referencia al modelo
use appComercial\Http\Requests\CosteoItemFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CosteoItemController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	// if ($request) {
    	// 	$query = trim($request->get('searchText'));
    	// 	$SedesJuridico = DB::table('tcosteoitem as ci')
    	// 	->join('tclientejuridico as cj','sj.codiClienJuri','=','cj.codiClienJuri')
    	// 	->select('sj.codiSedeJur','sj.descSedeJur','sj.estadoSedeJur','sj.fechaSistema','cj.razonSocialClienJ as Cliente')//campos a mostrar de la unión
    	// 	->where('sj.descSedeJur','LIKE','%'.$query.'%')
     	//	->where('sj.estadoSedeJur','=',1)
    	// 	->orwhere('sj.codiSedeJur','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    	// 	->orderBy('sj.codiSedeJur','desc')
    	// 	->paginate(5);
    	// 	return view('cotizaciones.index',["SedesJuridico"=>$SedesJuridico,"searchText"=>$query]);
    	// }

    	return "HOLA COSTEO-ITEM";
    }

    public function create(){
//    	$clientesJuridico = DB::table('tcosteoitem')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
//    	return view("nuevaCotizacion.create",["clientesJuridico"=>$clientesJuridico]);
    }

    public function store(Request $request){


    	return Redirect::to('nuevaCotizacion');
    }

    public function show($codiSedeJuridico){
    	return view('nuevaCotizacion.show',["SedesJuridico"=>SedeJuridico::findOrFail($codiSedeJuridico)]);
    }

    public function edit($codiCosteoItem){

//    	return view('nuevaCotizacion.edit',["SedeJuridico"=>$SedeJuridico, "clientesJuridico"=>$clientesJuridico]);
    }

    public function update(Request $request,$codiCosteoItem){

    	return Redirect::to('nuevaCotizacion');
    }

    public function delCosteoItem(Request $request){
        $codiCosteoItem = $request->get('codiCosteoItem');
        $costeoItem = CosteoItem::findOrFail($codiCosteoItem);
        if ($costeoItem->delete()){
            return "OK";
        }else{
            return "ERROR";
        }
    }
}
