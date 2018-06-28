<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\ProdCarta;//hacemos referencia al modelo
use DB;

class ProdCartaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));

            $dolar = DB::table('tprodcarta as d')
            ->where('d.estado','=',1)
            ->orwhere('dp.nombreDolarProveedor','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
            ->orderBy('d.dolarCompra','desc')
            ->paginate(5);

    		return view('dolar.index',["dolar"=>$dolar,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$dolarProveedor = DB::table('tdolarproveedor')->where('estado','=','1')->get();
    	return view("dolar.create",["dolarProveedor"=>$dolarProveedor]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(DolarFormRequest $request){
    	$dolar = new Dolar();
        $pk = new MyClass();

        $dolar->codiDolar = $pk->pk_generator("D");
        $dolar->dolarCompra = $request->get('txt_dolarCompra');
    	$dolar->dolarVenta = $request->get('txt_dolarVenta');
    	$dolar->fechaCambio = $request->get('txt_fechaCambio');
    	$dolar->codiDolarProveedor = $request->get('txt_codiDolarProveedor');
    	$dolar->codiCola = $request->get('txt_codiCola');
    	$dolar->estado = '1';
    	
    	$dolar->save();

    	return Redirect::to('dolar');
    }

    public function show($codiDolar){
    	return view('dolar.show',["dolar"=>Dolar::findOrFail($codiDolar)]);
    }

    public function edit($codiDolar){
    	$proveedores = DB::table('tdolarproveedor')->where('estado','=','1')->get();
        $colaborador = DB::table('tcolaborador')->where('estado','=','1')->get();

        return view('dolar.edit',["dolar"=>Dolar::findOrFail($codiDolar), "proveedores"=>$proveedores, "colaboradores"=>$colaborador]);
    }

    public function update(DolarFormRequest $request, $codiDolar){
    	$dolar = Dolar::findOrFail($codiDolar);

    	$dolar->dolarCompra = $request->get('txt_dolarCompra');
    	$dolar->dolarVenta = $request->get('txt_dolarVenta');
    	$dolar->fechaCambio = $request->get('txt_fechaCambio');
    	$dolar->codiDolarProveedor = $request->get('txt_codiDolarProveedor');
    	$dolar->codiCola = $request->get('txt_codiCola');
    	$dolar->estado = '1';
    	
    	$dolar->update();

    	return Redirect::to('dolar');
    }

    public function destroy($codiDolar){
    	$dolar = Dolar::findOrFail($codiDolar);
    	$dolar->estado = '0';
    	$dolar->update();
    	return Redirect::to('dolar');
    }
}
