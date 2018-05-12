<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\CondicionesComerciales;//hacemos referencia al modelo
use appComercial\Http\Requests\CondicionesComercialesFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CondicionesComercialesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$condicionesComerciales = DB::table('tcondicionescomerciales')->where('descripCondiComer','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('descripCondiComer','desc')
    		->paginate(5);
    		return view('condicionesComerciales.index',["condicionesComerciales"=>$condicionesComerciales,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("condicionesComerciales.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CondicionesComercialesFormRequest $request){
    	$condicionComercial = new CondicionesComerciales();
        $pk = new MyClass();

        $condicionComercial->codiCondiComer = $pk->pk_generator("CC");
        $condicionComercial->descripCondiComer = $request->get('txt_descripCondiComer');
    	$condicionComercial->defecCondiComer = $request->get('txt_defecCondiComer');
    	$condicionComercial->estado = '1';
    	
    	$condicionComercial->save();

    	return Redirect::to('condicionesComerciales');
    }

    public function show($codiCondiComer){
    	return view('condicionesComerciales.show',["condicionComercial"=>CondicionesComerciales::findOrFail($codiCondiComer)]);
    }

    public function edit($codiCondiComer){
        return view('condicionesComerciales.edit',["condicionComercial"=>CondicionesComerciales::findOrFail($codiCondiComer)]);
    }

    public function update(CondicionesComercialesFormRequest $request, $codiCondiComer){
    	$condicionComercial = CondicionesComerciales::findOrFail($codiCondiComer);

    	$condicionComercial->descripCondiComer = $request->get('txt_descripCondiComer');
    	$condicionComercial->defecCondiComer = $request->get('txt_defecCondiComer');
    	$condicionComercial->estado = '1';
    	
    	$condicionComercial->update();

    	return Redirect::to('condicionesComerciales');
    }

    public function destroy($codiCondiComer){
    	$condicionComercial = CondicionesComerciales::findOrFail($codiCondiComer);
    	$condicionComercial->estado = '0';
    	$condicionComercial->update();
    	return Redirect::to('condicionesComerciales');
    }
}
