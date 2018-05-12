<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\ProveedorContacto;//hacemos referencia al modelo
use appComercial\Http\Requests\ProveedorContactoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class ProveedorContactoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$provContac = DB::table('tproveedorcontacto')->where('nombreProveeContac','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('codiProveeContac','desc')
    		->paginate(5);
    		return view('proveedorContacto.index',["proveedorContactos"=>$provContac,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$proveedores = DB::table('tproveedor')->where('estaProveedor','=','1')->get();
    	$marcas = DB::table('tmarcaproducto')->where('estaMarca','=','1')->get();
    	$cargos = DB::table('tcargocontacto')->where('estaCargoContac','=','1')->get();
    	return view('proveedorContacto.create',["proveedores"=>$proveedores,"marcas"=>$marcas,"cargos"=>$cargos]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ProveedorContactoFormRequest $request){
    	$provContac = new ProveedorContacto();
        $pk = new MyClass();

        $provContac->codiProveeContac = $pk->pk_generator("PC");
    	$provContac->apePaterProveeC = $request->get('txt_apePaterProveeC');
    	$provContac->apeMaterProveeC = $request->get('txt_apeMaterProveeC');
    	$provContac->nombreProveeContac = $request->get('txt_nombreProveeContac');
    	$provContac->dniProveeContac = $request->get('txt_dniProveeContac');
    	$provContac->celu01ProveeContac = $request->get('txt_celu01ProveeContac');
    	$provContac->celu02ProveeContac = $request->get('txt_celu02ProveeContac');
    	$provContac->tele01ProveeContac = $request->get('txt_tele01ProveeContac');
    	$provContac->anexoProveeContac = $request->get('txt_anexoProveeContac');
    	$provContac->correo01ProveeContac = $request->get('txt_correo01ProveeContac');
    	$provContac->correo02ProveeContac = $request->get('txt_correo02ProveeContac');
    	$provContac->skypeProveeContac = $request->get('txt_skypeProveeContac');
    	$provContac->codiProveedor = $request->get('txt_codiProveedor');
    	$provContac->codiMarca = $request->get('txt_codiMarca');
    	$provContac->codiCargoContac = $request->get('txt_codiCargoContac');
    	$provContac->detalle = $request->get('txt_detalle');
    	$provContac->estado = '1';

    	$provContac->save();

    	return Redirect::to('proveedorContacto');
    }

    public function show($codiProvContacto){
    	return view('proveedorContacto.show',["proveedorContactos"=>ProveedorContacto::findOrFail($codiProvContacto)]);
    }

    public function edit($codiProvContacto){
    	$proveedores = DB::table('tproveedor')->where('estaProveedor','=','1')->get();
    	$marcas = DB::table('tmarcaproducto')->where('estaMarca','=','1')->get();
    	$cargos = DB::table('tcargocontacto')->where('estaCargoContac','=','1')->get();
        return view('proveedorContacto.edit',["proveedorContactos"=>ProveedorContacto::findOrFail($codiProvContacto),"proveedores"=>$proveedores,"marcas"=>$marcas,"cargos"=>$cargos]);
    }

    public function update(ProveedorContactoFormRequest $request, $codiProvContacto){
    	$provContac = ProveedorContacto::findOrFail($codiProvContacto);

    	$provContac->apePaterProveeC = $request->get('txt_apePaterProveeC');
    	$provContac->apeMaterProveeC = $request->get('txt_apeMaterProveeC');
    	$provContac->nombreProveeContac = $request->get('txt_nombreProveeContac');
    	$provContac->dniProveeContac = $request->get('txt_dniProveeContac');
    	$provContac->celu01ProveeContac = $request->get('txt_celu01ProveeContac');
    	$provContac->celu02ProveeContac = $request->get('txt_celu02ProveeContac');
    	$provContac->tele01ProveeContac = $request->get('txt_tele01ProveeContac');
    	$provContac->anexoProveeContac = $request->get('txt_anexoProveeContac');
    	$provContac->correo01ProveeContac = $request->get('txt_correo01ProveeContac');
    	$provContac->correo02ProveeContac = $request->get('txt_correo02ProveeContac');
    	$provContac->skypeProveeContac = $request->get('txt_skypeProveeContac');
    	$provContac->codiProveedor = $request->get('txt_codiProveedor');
    	$provContac->codiMarca = $request->get('txt_codiMarca');
    	$provContac->codiCargoContac = $request->get('txt_codiCargoContac');
    	$provContac->detalle = $request->get('txt_detalle');
    	$provContac->estado = '1';
    	
    	$provContac->update();

    	return Redirect::to('proveedorContacto');
    }

    public function destroy($codiProvContacto){
    	$provContac = ProveedorContacto::findOrFail($codiProvContacto);
    	$provContac->estado = '0';
    	$provContac->update();
    	return Redirect::to('proveedorContacto');
    }
}
