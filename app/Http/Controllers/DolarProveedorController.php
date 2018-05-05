<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\DolarProveedor;//hacemos referencia al modelo
use appComercial\Http\Requests\DolarProveedorFormRequest;
use appComercial\Custom\MyClass;
use DB;

class DolarProveedorController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$dolarProveedor = DB::table('tdolarproveedor')->where('nombreDolarProveedor','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('nombreDolarProveedor','desc')
    		->paginate(5);
    		return view('dolarProveedor.index',["dolarProveedor"=>$dolarProveedor,"searchText"=>$query]);
    	}
    }

    public function create(){    	
    	return view("dolarProveedor.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(DolarProveedorFormRequest $request){
    	$dolarProveedor = new DolarProveedor();
        $pk = new MyClass();

        $dolarProveedor->codiDolarProveedor = $pk->pk_generator("DP");
        $dolarProveedor->nombreDolarProveedor = $request->get('txt_nombreDolarProveedor');
    	$dolarProveedor->nombreBreveDolarProveedor = $request->get('txt_nombreBreveDolarProveedor');
    	$dolarProveedor->estaDolarProveedor = '1';
    	$dolarProveedor->defectoDolarProveedor = $request->get('txt_defectoDolarProveedor');
    	$dolarProveedor->estado = '1';
    	
    	$dolarProveedor->save();

    	return Redirect::to('dolarProveedor');
    }

    public function show($codiDolarProveedor){
    	return view('dolarProveedor.show',["dolarProveedor"=>DolarProveedor::findOrFail($codiDolarProveedor)]);
    }

    public function edit($codiDolarProveedor){
        return view('dolarProveedor.edit',["dolarProveedor"=>DolarProveedor::findOrFail($codiDolarProveedor)]);
    }

    public function update(DolarProveedorFormRequest $request, $codiDolarProveedor){
    	$dolarProveedor = DolarProveedor::findOrFail($codiDolarProveedor);

    	$dolarProveedor->nombreDolarProveedor = $request->get('txt_nombreDolarProveedor');
    	$dolarProveedor->nombreBreveDolarProveedor = $request->get('txt_nombreBreveDolarProveedor');
    	$dolarProveedor->estaDolarProveedor = $request->get('txt_estaDolarProveedor');
    	$dolarProveedor->defectoDolarProveedor = $request->get('txt_defectoDolarProveedor');
    	$dolarProveedor->estado = '1';
    	
    	$dolarProveedor->update();

    	return Redirect::to('dolarProveedor');
    }

    public function destroy($codiDolarProveedor){
    	$dolarProveedor = DolarProveedor::findOrFail($codiDolarProveedor);
    	$dolarProveedor->estado = '0';
    	$dolarProveedor->update();
    	return Redirect::to('dolarProveedor');
    }
}
