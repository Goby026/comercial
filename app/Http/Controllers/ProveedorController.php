<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Proveedor;//hacemos referencia al modelo
use appComercial\Http\Requests\ProveedorFormRequest;
use appComercial\Custom\MyClass;
use DB;

class ProveedorController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$proveedor = DB::table('tproveedor')->where('nombreProveedor','LIKE','%'.$query.'%')
    		->where('estaProveedor','=','1')
    		->orderBy('nombreProveedor','desc')
    		->paginate(5);
    		return view('proveedores.index',["proveedores"=>$proveedor,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("proveedores.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ProveedorFormRequest $request){
    	$proveedor = new Proveedor();
        $pk = new MyClass();

        $proveedor->codiProveedor = $pk->pk_generator("P");
    	$proveedor->nombreProveedor = $request->get('txt_nombreProveedor');
    	$proveedor->nombreBreveProveedor = $request->get('txt_nombreBreveProveedor');
    	$proveedor->RucProveedor = $request->get('txt_RucProveedor');
    	$proveedor->direcProveedor = $request->get('txt_direcProveedor');
    	$proveedor->webProveedor = $request->get('txt_webProveedor');
    	$proveedor->estaProveedor = '1';
    	$proveedor->codiDistri = $request->get('txt_codiDistri');
    	$proveedor->codiProvin = $request->get('txt_codiProvin');
    	$proveedor->codiDepar = $request->get('txt_codiDepar');

    	$proveedor->save();

    	return Redirect::to('proveedores');
    }

    public function show($codiProveedor){
    	return view('proveedores.show',["proveedores"=>Proveedor::findOrFail($codiProveedor)]);
    }

    public function edit($codiProveedor){
        return view('proveedores.edit',["proveedores"=>Proveedor::findOrFail($codiProveedor)]);
    }

    public function update(ProveedorFormRequest $request, $codiProveedor){
    	$proveedor = Proveedor::findOrFail($codiProveedor);

    	$proveedor->nombreProveedor = $request->get('txt_nombreProveedor');
    	$proveedor->nombreBreveProveedor = $request->get('txt_nombreBreveProveedor');
    	$proveedor->RucProveedor = $request->get('txt_RucProveedor');
    	$proveedor->direcProveedor = $request->get('txt_direcProveedor');
    	$proveedor->webProveedor = $request->get('txt_webProveedor');
    	$proveedor->estaProveedor = '1';
    	$proveedor->codiDistri = $request->get('txt_codiDistri');
    	$proveedor->codiProvin = $request->get('txt_codiProvin');
    	$proveedor->codiDepar = $request->get('txt_codiDepar');
    	
    	$proveedor->update();

    	return Redirect::to('proveedores');
    }

    public function destroy($codiProveedor){
    	$proveedor = Proveedor::findOrFail($codiProveedor);
    	$proveedor->estaProveedor = '0';
    	$proveedor->update();
    	return Redirect::to('proveedores');
    }
}
