<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\CosteoEstado;//hacemos referencia al modelo
use appComercial\Http\Requests\CosteoEstadoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CosteoEstadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$costeoEstados = DB::table('tcosteoestado')->where('nombreCosteoEsta','LIKE','%'.$query.'%')
    		->where('estaCosteoEsta','=','1')
    		->orderBy('nombreCosteoEsta','desc')
    		->paginate(5);
    		return view('costeoEstados.index',["costeoEstados"=>$costeoEstados,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("costeoEstados.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CosteoEstadoFormRequest $request){
    	$costeoEstado = new CosteoEstado();
        $pk = new MyClass();

        $costeoEstado->codiCosteoEsta = $pk->pk_generator("CE");
        $costeoEstado->nombreCosteoEsta = $request->get('txt_nombreCosteoEsta');
    	$costeoEstado->nombreBreveCosteoEsta = $request->get('txt_nombreBreveCosteoEsta');
    	$costeoEstado->ordenCosteoEsta = $request->get('txt_ordenCosteoEsta');
    	$costeoEstado->estaCosteoEsta = '1';
    	
    	$costeoEstado->save();

    	return Redirect::to('costeoEstados');
    }

    public function show($codiCosteoEsta){
    	return view('costeoEstados.show',["costeoEstado"=>CosteoEstado::findOrFail($codiCosteoEsta)]);
    }

    public function edit($codiCosteoEsta){
        return view('costeoEstados.edit',["costeoEstado"=>CosteoEstado::findOrFail($codiCosteoEsta)]);
    }

    public function update(CosteoEstadoFormRequest $request, $codiCosteoEsta){
    	$costeoEstado = CosteoEstado::findOrFail($codiCosteoEsta);

    	$costeoEstado->nombreCosteoEsta = $request->get('txt_nombreCosteoEsta');
    	$costeoEstado->nombreBreveCosteoEsta = $request->get('txt_nombreBreveCosteoEsta');
    	$costeoEstado->ordenCosteoEsta = $request->get('txt_ordenCosteoEsta');
    	$costeoEstado->estaCosteoEsta = '1';
    	
    	$costeoEstado->update();

    	return Redirect::to('costeoEstados');
    }

    public function destroy($codiCosteoEsta){
    	$costeoEstado = CosteoEstado::findOrFail($codiCosteoEsta);
    	$costeoEstado->estaCosteoEsta = '0';
    	$costeoEstado->update();
    	return Redirect::to('costeoEstados');
    }
}
