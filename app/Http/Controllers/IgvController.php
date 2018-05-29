<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\Igv;//hacemos referencia al modelo
use appComercial\Http\Requests\IgvFormRequest;
use appComercial\Custom\MyClass;
use DB;

class IgvController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$igv = DB::table('tigv')->where('valorIgv','LIKE','%'.$query.'%')
    		->where('estaIgv','=','1')
    		->orderBy('fechaInIgv','desc')
    		->paginate(5);
    		return view('igv.index',["igv"=>$igv,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$colaboradores = DB::table('tcolaborador')->where('estado','=','1')->get();
    	return view("igv.create",["colaboradores"=>$colaboradores]);        
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(IgvFormRequest $request){
    	$igv = new Igv();
        $pk = new MyClass();

        $igv->codiIgv = $pk->pk_generator("IGV");
        $igv->codiCola = $request->get('txt_codiCola');
    	$igv->valorIgv = $request->get('txt_valorIgv');
    	$igv->fechaInIgv = $request->get('txt_fechaInIgv');
    	$igv->fechaFinalIgv = $request->get('txt_fechaFinalIgv');
    	$igv->estaIgv = '1';
    	
    	$igv->save();

    	return Redirect::to('igv');
    }

    public function show($codiIgv){
    	return view('igv.show',["igv"=>Igv::findOrFail($codiIgv)]);
    }

    public function edit($codiIgv){
        return view('igv.edit',["igv"=>Igv::findOrFail($codiIgv)]);
    }

    public function update(IgvFormRequest $request, $codiIgv){
    	$igv = Igv::findOrFail($codiIgv);

    	$igv->codiCola = $request->get('txt_codiCola');
    	$igv->valorIgv = $request->get('txt_valorIgv');
    	$igv->fechaInIgv = $request->get('txt_fechaInIgv');
    	$igv->fechaFinalIgv = $request->get('txt_fechaFinalIgv');
    	$igv->estaIgv = '1';
    	
    	$igv->update();

    	return Redirect::to('igv');
    }

    public function destroy($codiIgv){
    	$igv = Igv::findOrFail($codiIgv);
    	$igv->estaIgv = '0';
    	$igv->update();
    	return Redirect::to('igv');
    }
}
