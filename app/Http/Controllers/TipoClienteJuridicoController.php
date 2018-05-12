<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;
use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
// use Illuminate\Support\Facades\Input;//para subir imagenes al servidor
use appComercial\Http\Requests\TipoClienteJuridicoFormRequest;
use appComercial\TipoClienteJuridico;//hacemos referencia al modelo
use appComercial\Custom\MyClass;//clase donde esta el generador de pk
use DB;

class TipoClienteJuridicoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('descTipoCliJur','LIKE','%'.$query.'%')
    		->where('estadoTipoCliJur','=','1')
    		->orderBy('fechaSistema','desc')
    		->paginate(5);
    		return view('tipoClientesJuridicos.index',["tipoClientesJuridicos"=>$tipoClienteJuridico,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("tipoClientesJuridicos.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(TipoClienteJuridicoFormRequest $request){
        $pk = new MyClass();
    	$tipoClienteJuridico = new TipoClienteJuridico();
    	$tipoClienteJuridico->codiTipoCliJur = $pk->pk_generator("TCJ");
        $tipoClienteJuridico->descTipoCliJur = $request->get('txtDescripcion');
    	$tipoClienteJuridico->estadoTipoCliJur = '1';

    	$tipoClienteJuridico->save();

    	return Redirect::to('tipoClientesJuridicos');
    }

    public function show($codiTipoClienteJuridico){
    	return view('tipoClientesJuridicos.show',["tipoClientesJuridicos"=>TipoClienteJuridico::findOrFail($codiTipoClienteJuridico)]);
    }

    public function edit($id){
        return view('tipoClientesJuridicos.edit',["tipoClientesJuridicos"=>TipoClienteJuridico::findOrFail($id)]);        
    }

    public function update(TipoClienteFormRequest $request,$codiTipoClienteJuridico){
    	$tipoCliente = TipoClienteJuridico::findOrFail($codiTipoClienteJuridico);
    	$tipoCliente->nombreTipoCliente = $request->get('txtNombre');
    	$tipoCliente->nombreBreveTipoCliente = $request->get('txtNombreBreve');
        
    	$tipoCliente->update();

    	return Redirect::to('tipoClientesJuridicos');
    }

    public function destroy($codiTipoClienteJuridico){
    	$tipoClienteJuridico = TipoClienteJuridico::findOrFail($codiTipoClienteJuridico);
    	$tipoClienteJuridico->estadoTipoCliJur = '0';
    	$tipoClienteJuridico->update();
    	return Redirect::to('tipoClientesJuridicos');
    }
}
