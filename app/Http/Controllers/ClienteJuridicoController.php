<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\ClienteJuridico;//hacemos referencia al modelo
use appComercial\Http\Requests\ClienteJuridicoFormRequest;
use appComercial\Custom\MyClass;
use DB;


class ClienteJuridicoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$ClientesJuridicos = DB::table('tclientejuridico as c')
    		->join('ttipoclientejuridico as tc','c.codiTipoCliJur','=','tc.codiTipoCliJur')
    		->select('c.codiClienJuri','c.razonSocialClienJ','c.rucClienJuri','c.direcClienJuri','c.codiDistri','c.codiProvin','c.codiDepar','tc.descTipoCliJur as tipo','c.webClienJuri','c.estado')//campos a mostrar de la unión
    		->where('c.razonSocialClienJ','LIKE','%'.$query.'%')
            ->where('c.estado','=','1')
    		->orwhere('c.rucClienJuri','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    		->orderBy('c.razonSocialClienJ','desc')
    		->paginate(20);
    		return view('clientesJuridicos.index',["ClientesJuridicos"=>$ClientesJuridicos,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('estadoTipoCliJur','=','1')->get();

    	return view("clientesJuridicos.create",["tipoClientesJuridicos"=>$tipoClienteJuridico]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ClienteJuridicoFormRequest $request){
    	$ClienteJuridico = new ClienteJuridico();
        $pk = new MyClass();

        $ClienteJuridico->codiClienJuri = $pk->pk_generator("CJ");
    	$ClienteJuridico->razonSocialClienJ = $request->get('txt_razonSocial');
    	$ClienteJuridico->rucClienJuri = $request->get('txt_ruc');
    	$ClienteJuridico->direcClienJuri = $request->get('txt_direccion');
    	$ClienteJuridico->codiDistri = $request->get('txt_codiDistri');
    	$ClienteJuridico->codiProvin = $request->get('txt_codiProvin');
    	$ClienteJuridico->codiDepar = $request->get('txt_codiDepar');
    	$ClienteJuridico->codiTipoCliJur = $request->get('idTipocli');
    	$ClienteJuridico->webClienJuri = $request->get('txt_web');
    	$ClienteJuridico->estado = 1;

    	$ClienteJuridico->save();

    	return Redirect::to('clientesJuridicos');
    }

    public function show($codiClienteJuridico){
    	return view('clientesJuridicos.show',["ClientesJuridicos"=>ClienteJuridico::findOrFail($codiClienteJuridico)]);
    }

    public function edit($codiClienteJuridico){
    	$ClienteJuridico =ClienteJuridico::findOrFail($codiClienteJuridico);
    	$tipoClienteJuridico = DB::table('ttipoclientejuridico')->where('estadoTipoCliJur','=','1')->get();//obtener los tipo de cliente jur. ACTIVOS
    	return view('clientesJuridicos.edit',["ClientesJuridicos"=>$ClienteJuridico, "tipoClientesJuridicos"=>$tipoClienteJuridico]);
    }

    public function update(ClienteJuridicoFormRequest $request,$codiClienteJuridico){
    	$ClienteJuridico = ClienteJuridico::findOrFail($codiClienteJuridico);

    	$ClienteJuridico->razonSocialClienJ = $request->get('txt_razonSocial');
    	$ClienteJuridico->rucClienJuri = $request->get('txt_ruc');
    	$ClienteJuridico->direcClienJuri = $request->get('txt_direccion');
    	$ClienteJuridico->codiDistri = $request->get('txt_codiDistri');
    	$ClienteJuridico->codiProvin = $request->get('txt_codiProvin');
    	$ClienteJuridico->codiDepar = $request->get('txt_codiDepar');
    	$ClienteJuridico->codiTipoCliJur = $request->get('idTipocli');
    	$ClienteJuridico->webClienJuri = $request->get('txt_web');
        
    	$ClienteJuridico->update();

    	return Redirect::to('clientesJuridicos');
    }

    public function destroy($codiClienteJuridico){
    	$ClienteJuridico = ClienteJuridico::findOrFail($codiClienteJuridico);
    	$ClienteJuridico->estado = '0';
    	$ClienteJuridico->update();
    	return Redirect::to('clientesJuridicos');
    }
}
