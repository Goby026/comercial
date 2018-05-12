<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\SedeJuridico;//hacemos referencia al modelo
use appComercial\Http\Requests\SedeJuridicoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class SedeJuridicoController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$SedesJuridico = DB::table('tsedejuridico as sj')
    		->join('tclientejuridico as cj','sj.codiClienJuri','=','cj.codiClienJuri')
    		->select('sj.codiSedeJur','sj.descSedeJur','sj.estadoSedeJur','sj.fechaSistema','cj.razonSocialClienJ as Cliente')//campos a mostrar de la unión
    		->where('sj.descSedeJur','LIKE','%'.$query.'%')
            ->where('sj.estadoSedeJur','=',1)
    		->orwhere('sj.codiSedeJur','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    		->orderBy('sj.codiSedeJur','desc')
    		->paginate(5);
    		return view('sedesJuridicos.index',["SedesJuridico"=>$SedesJuridico,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$clientesJuridico = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
    	return view("sedesJuridicos.create",["clientesJuridico"=>$clientesJuridico]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(SedeJuridicoFormRequest $request){
    	$SedeJuridico = new SedeJuridico();
        $pk = new MyClass();

        $SedeJuridico->codiSedeJur = $pk->pk_generator("SJ");
    	$SedeJuridico->descSedeJur = $request->get('txt_descSedeJur');
    	$SedeJuridico->codiClienJuri = $request->get('txt_codiClienJuri');
    	$SedeJuridico->estadoSedeJur = 1;
    	
    	// PARA REGISTRAR IMAGENES
    	// if (Input::hasFile('txt_imagen')) {
    	// 	$file=file('txt_imagen');
    	// 	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    	// 	$ClienteJuridico->imgClienJuri = $file->getClientOriginalName();
    	// }

    	$SedeJuridico->save();

    	return Redirect::to('sedesJuridicos');
    }

    public function show($codiSedeJuridico){
    	return view('sedesJuridicos.show',["SedesJuridico"=>SedeJuridico::findOrFail($codiSedeJuridico)]);
    }

    public function edit($codiSedeJuridico){
    	$SedeJuridico =SedeJuridico::findOrFail($codiSedeJuridico);
    	$clientesJuridico = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
    	//print_r($clientesJuridico);
    	return view('sedesJuridicos.edit',["SedeJuridico"=>$SedeJuridico, "clientesJuridico"=>$clientesJuridico]);
    }

    public function update(SedeJuridicoFormRequest $request,$codiSedeJuridico){
    	$SedeJuridico = SedeJuridico::findOrFail($codiSedeJuridico);

    	$SedeJuridico->descSedeJur = $request->get('txt_descSedeJur');
    	$SedeJuridico->estadoSedeJur = 1;
    	$SedeJuridico->codiClienJuri = $request->get('txt_codiClienJuri');
    	$SedeJuridico->update();

    	return Redirect::to('sedesJuridicos');
    }

    public function destroy($codiClienteJuridico){
    	$SedeJuridico = SedeJuridico::findOrFail($codiClienteJuridico);
    	$SedeJuridico->estadoSedeJur = 0;
    	$SedeJuridico->update();
    	return Redirect::to('sedesJuridicos');
    }
}
