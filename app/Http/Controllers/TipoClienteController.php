<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;
use appComercial\TipoCliente;//hacemos referencia al modelo
use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use appComercial\Http\Requests\TipoClienteFormRequest;
use appComercial\Custom\MyClass;
use DB;

class TipoClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$tipoClientes = DB::table('ttipocliente')->where('nombreTipoCliente','LIKE','%'.$query.'%')
    		->where('estaTipoCliente','=','1')
    		->orderBy('nombreTipoCliente','desc')
    		->paginate(5);
    		return view('tiposClientes.index',["tipoClientes"=>$tipoClientes,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("tiposClientes.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(TipoClienteFormRequest $request){
    	$tipoCliente = new TipoCliente();
        $pk = new MyClass();

        $tipoCliente->codiTipoCliente = $pk->pk_generator("TC");
    	$tipoCliente->nombreTipoCliente = $request->get('txtNombre');
    	$tipoCliente->nombreBreveTipoCliente = $request->get('txtNombreBreve');
    	$tipoCliente->entidad = $request->get('txtEntidad');
    	$tipoCliente->estaTipoCliente = '1';

    	$tipoCliente->save();

    	return Redirect::to('tiposClientes');
    }

    public function show($codiTipoCliente){
    	return view('tiposClientes.show',["tipoCliente"=>TipoCliente::findOrFail($codiTipoCliente)]);
    }

    public function edit($id){
        return view('tiposClientes.edit',["tipoCliente"=>TipoCliente::findOrFail($id)]);
    }

    public function update(TipoClienteFormRequest $request,$codiTipoCliente){
		$tipoCliente = TipoCliente::findOrFail($codiTipoCliente);
		
    	$tipoCliente->nombreTipoCliente = $request->get('txtNombre');
    	$tipoCliente->nombreBreveTipoCliente = $request->get('txtNombreBreve');
		$tipoCliente->entidad = $request->get('txtEntidad');
		$tipoCliente->estaTipoCliente = '1';
    	$tipoCliente->update();

    	return Redirect::to('tiposClientes');
    }

    public function destroy($codiTipoCliente){
    	$tipoCliente = TipoCliente::findOrFail($codiTipoCliente);
    	$tipoCliente->estaTipoCliente = '0';
    	$tipoCliente->update();
    	return Redirect::to('tiposClientes');
    }
}
