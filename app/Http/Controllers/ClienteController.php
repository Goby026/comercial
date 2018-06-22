<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use appComercial\TipoCliente;
use appComercial\Cliente;//hacemos referencia al modelo
use appComercial\ClienteNatural;
use appComercial\ClienteJuridico;
use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
// use appComercial\Http\Requests\ClienteFormRequest;
use appComercial\Custom\MyClass;
use DB;

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	/*
	Para que funcione bien esta entidad, se debe tener en cuenta lo sgte:
	las entidades tclientenatural y tclientejuridico deben tener los siguientes registros nulos:
		tclientenatural(codiClienNatu = '001', null,null,null,null, estado = 0)
		tclientejuridico(codiClienJuri = '001', null,null,null,null, estado = 0)
	por lo tanto cuando se registre un cliente nuevo se debe indicar alguno de los codigos anteriores para poder realizar las busquedas ejem:
		si se quiere registrar un cliente natural debe ser:
			tcliente(codiClien='correspondiente', codiTipoCliente='correspondiente', codiClienJuri='001', codiClienNatu='correspondiente', codiCola='correspondiente', estado='correspondiente', fecha='correspondiente')
		si se quiere registrar un cliente juridico debe ser:
			tcliente(codiClien='correspondiente', codiTipoCliente='correspondiente', codiClienJuri='correspondiente', codiClienNatu='001', codiCola='correspondiente', estado='correspondiente', fecha='correspondiente')
	*/

    public function index(Request $request){
		if ($request) {
			$query = trim($request->get('searchText'));
			$clientes = DB::table('tcliente as c')
			->join('ttipocliente as tc','c.codiTipoCliente','=','tc.codiTipoCliente')
			->join('tclientenatural as cn','c.codiClienNatu','=','cn.codiClienNatu')
			->join('tclientejuridico as cj','c.codiClienJuri','=','cj.codiClienJuri')
			->select('c.codiClien','c.codiClienJuri','c.codiClienNatu','cn.apePaterClienN','cn.apeMaterClienN','nombreClienNatu','cj.razonSocialClienJ','tc.nombreTipoCliente','cn.dniClienNatu', 'cj.rucClienJuri', 'c.estado')//campos a mostrar de la unión
			->where('cn.apePaterClienN','LIKE','%'.$query.'%')
			->where('c.estado','=',1)
			->orwhere('cj.razonSocialClienJ','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
			->orwhere('cj.rucClienJuri','LIKE','%'.$query.'%')
			->orderBy('c.codiClien','desc')
			->paginate(5);
			return view('clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
		}
	}

    public function create(){
    	return view("clientes.create");
        //echo $this->pk_generator("TCJ");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(TipoClienteFormRequest $request){
    	$tipoCliente = new TipoCliente();
        $pk = new MyClass();

        $tipoCliente->codiTipoCliente = $pk->pk_generator("TC");
    	$tipoCliente->nombreTipoCliente = $request->get('txtNombre');
    	$tipoCliente->nombreBreveTipoCliente = $request->get('txtNombreBreve');
    	$tipoCliente->estaTipoCliente = '1';

    	$tipoCliente->save();

		return Redirect::to('clientes');
    }

    public function show($codiTipoCliente){
    	return view('clientes.show',["tipoCliente"=>TipoCliente::findOrFail($codiTipoCliente)]);
    }

    public function edit($id){
        return view('clientes.edit',["tipoCliente"=>TipoCliente::findOrFail($id)]);        
    }

    public function update(TipoClienteFormRequest $request,$codiTipoCliente){
    	$tipoCliente = TipoCliente::findOrFail($codiTipoCliente);
    	$tipoCliente->nombreTipoCliente = $request->get('txtNombre');
    	$tipoCliente->nombreBreveTipoCliente = $request->get('txtNombreBreve');
        
    	$tipoCliente->update();

    	return Redirect::to('clientes');
    }

    public function destroy($codiTipoCliente){
    	$tipoCliente = TipoCliente::findOrFail($codiTipoCliente);
    	$tipoCliente->estaTipoCliente = '0';
    	$tipoCliente->update();
    	return Redirect::to('clientes');
	}
	
	public function addCli(Request $request)
	{
		$pk = new MyClass();

		$codiClienJuri = "001";
		$codiClienNatu = "001";

			if ($request->get("txt_razonSocial") != "") {//cliente juridico
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

				$codiClienJuri = $ClienteJuridico->codiClienJuri;

			}else{//cliente natural
				$ClienteNatural = new ClienteNatural();
				$pk = new MyClass();

				$ClienteNatural->codiClienNatu = $pk->pk_generator("CN");
				$ClienteNatural->apePaterClienN = $request->get('txt_apePaterClienN');
				$ClienteNatural->apeMaterClienN = $request->get('txt_apeMaterClienN');
				$ClienteNatural->nombreClienNatu = $request->get('txt_nombreClienNatu');
				$ClienteNatural->dniClienNatu = $request->get('txt_dniClienNatu');
				$ClienteNatural->direcClienNatu = $request->get('txt_direcClienNatu');
				$ClienteNatural->codiDistri = $request->get('txt_codiDistri');
				$ClienteNatural->codiProvin = $request->get('txt_codiProvin');
				$ClienteNatural->codiDepar = $request->get('txt_codiDepar');
				$ClienteNatural->fechaNaciClienN = $request->get('txt_fechaNaciClienN');
				$ClienteNatural->correoClienNatu = $request->get('txt_correoClienNatu');
				$ClienteNatural->tele01ClienNatu = $request->get('txt_tele01ClienNatu');
				$ClienteNatural->tele02ClienNatu = $request->get('txt_tele02ClienNatu');
				$ClienteNatural->estado = 1;

				$ClienteNatural->save();

				$codiClienNatu = $ClienteNatural->codiClienNatu;
			}

			$cliente = new Cliente();

			$cliente->codiClien = $pk->pk_generator("C");
			$cliente->codiTipoCliente = $request->get('txt_codiTipoCliente');
			$cliente->codiClienJuri = $codiClienJuri;
			$cliente->codiClienNatu = $codiClienNatu;
			$cliente->codiCola = $request->get('txt_codiCola');
			$cliente->estado = "1";

			if ($cliente->save()) {
				echo 1;
			}
		}

    public function saveCliNatu(Request $request){
    	$ClienteNatural = new ClienteNatural();
        $pk = new MyClass();

        $ClienteNatural->codiClienNatu = $pk->pk_generator("CN");
    	$ClienteNatural->apePaterClienN = $request->get('txt_apePaterClienN');
    	$ClienteNatural->apeMaterClienN = $request->get('txt_apeMaterClienN');
    	$ClienteNatural->nombreClienNatu = $request->get('txt_nombreClienNatu');
    	$ClienteNatural->dniClienNatu = $request->get('txt_dniClienNatu');
    	$ClienteNatural->direcClienNatu = $request->get('txt_direcClienNatu');
    	$ClienteNatural->codiDistri = $request->get('txt_codiDistri');
    	$ClienteNatural->codiProvin = $request->get('txt_codiProvin');
    	$ClienteNatural->codiDepar = $request->get('txt_codiDepar');
    	$ClienteNatural->fechaNaciClienN = $request->get('txt_fechaNaciClienN');
    	$ClienteNatural->correoClienNatu = $request->get('txt_correoClienNatu');
    	$ClienteNatural->tele01ClienNatu = $request->get('txt_tele01ClienNatu');
    	$ClienteNatural->tele02ClienNatu = $request->get('txt_tele02ClienNatu');
    	$ClienteNatural->estado = 1;

    	if ($ClienteNatural->save()) {
    		echo "Correctamente";
    	}else{
    		echo "Error";
    	}
    	// return Redirect::to('clientesNaturales');
    }

    public function saveCliJuri(Request $request){
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

    	if ($ClienteJuridico->save()) {
    		echo "Correctamente";
    	}else{
    		echo "Error";
    	}
    }
}
