<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\Familia;//hacemos referencia al modelo
use appComercial\Http\Requests\FamiliaFormRequest;
use appComercial\Custom\MyClass;
use DB;

class FamiliaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));

            $familias = DB::table('tfamilia')->where('estado','=','1')
    		->orderBy('fechaSistema','desc')
    		->paginate(5);

    		return view('familias.index',["familias"=>$familias,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("familias.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(FamiliaFormRequest $request){
    	$familia = new Familia();
        $pk = new MyClass();

        $familia->codiFamilia = $pk->pk_generator("F");
        $familia->nombreFamilia = $request->get('txt_nombreFamilia');
        $familia->nombreBreveFamilia = $request->get('txt_nombreBreveFamilia');
    	$familia->estado = '1';
    	
    	$familia->save();

    	return Redirect::to('familias');
    }

    public function show($codiFamilia){
    	return view('familias.show', ["familia"=>Familia::findOrFail($codiFamilia)]);
    }

    public function edit($codiFamilia){
        return view('familias.edit',["familia"=>Familia::findOrFail($codiFamilia)]);
    }

    public function update(FamiliaFormRequest $request, $codiFamilia){
    	$familia = Familia::findOrFail($codiFamilia);

    	$familia->nombreFamilia = $request->get('txt_nombreFamilia');
        $familia->nombreBreveFamilia = $request->get('txt_nombreBreveFamilia');
    	$familia->estado = '1';
    	
    	$familia->update();

    	return Redirect::to('familias');
    }

    public function destroy($codiDolar){
    	$familia = Familia::findOrFail($codiDolar);
    	$familia->estado = '0';
    	$familia->update();
    	return Redirect::to('familias');
    }
}
