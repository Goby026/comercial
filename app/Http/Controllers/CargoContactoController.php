<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\CargoContacto;//hacemos referencia al modelo
use appComercial\Http\Requests\CargoContactoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CargoContactoController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$cargos = DB::table('tcargocontacto')->where('nombreCargoContac','LIKE','%'.$query.'%')
    		->where('estaCargoContac','=','1')
    		->orderBy('codiCargoContac','desc')
    		->paginate(5);
    		return view('cargoContactos.index',["cargos"=>$cargos,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("cargoContactos.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CargoContactoFormRequest $request){
    	$cargo = new CargoContacto();
        $pk = new MyClass();

        $cargo->codiCargoContac = $pk->pk_generator("CC");
    	$cargo->nombreCargoContac = $request->get('txt_nombreCargoContac');
    	$cargo->nombreBreveCargoContac = $request->get('txt_nombreBreveCargoContac');
    	$cargo->estaCargoContac = '1';

    	$cargo->save();

    	return Redirect::to('cargoContactos');
    }

    public function show($codiCargoContac){
    	return view('cargoContactos.show',["cargos"=>CargoContacto::findOrFail($codiCargoContac)]);
    }

    public function edit($codiCargoContac){
        return view('cargoContactos.edit',["cargos"=>CargoContacto::findOrFail($codiCargoContac)]);
    }

    public function update(CargoContactoFormRequest $request, $codiCargoContacto){
    	$cargo = CargoContacto::findOrFail($codiCargoContacto);

    	$cargo->nombreCargoContac = $request->get('txt_nombreCargoContac');
    	$cargo->nombreBreveCargoContac = $request->get('txt_nombreBreveCargoContac');
    	
    	$cargo->update();

    	return Redirect::to('cargoContactos');
    }

    public function destroy($codiCargoContacto){
    	$cargo = CargoContacto::findOrFail($codiCargoContacto);
    	$cargo->estaCargoContac = '0';
    	$cargo->update();
    	return Redirect::to('cargoContactos');
    }
}
