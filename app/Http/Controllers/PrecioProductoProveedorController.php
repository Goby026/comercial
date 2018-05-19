<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\PrecioProductoProveedor;//hacemos referencia al modelo
use appComercial\Http\Requests\PrecioProductoProveedorFormRequest;
use appComercial\Custom\MyClass;
use Carbon\Carbon;
use DB;

class PrecioProductoProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$precios = DB::table('tprecioproductoproveedor as ppp')
    		->join('tproductoproveedor as pp','ppp.codiProducProveedor','=','pp.codiProducProveedor')
    		->join('tproveedor as p','ppp.codiProveedor','=','p.codiProveedor')
    		->join('tcolaborador as c','ppp.codiCola','=','c.codiCola')
    		->select('ppp.idTPrecioProductoProveedor','pp.nombreProducProveedor','p.nombreProveedor','ppp.precioProducDolar','c.nombreCola', 'ppp.estado')//campos a mostrar de la unión
    		->where('pp.nombreProducProveedor','LIKE','%'.$query.'%')
    		->where('c.estado','=',1)
    		->orwhere('p.nombreProveedor','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    		->orderBy('pp.nombreProducProveedor','desc')
    		->paginate(5);
    		return view('precioProductoProveedor.index',["precios"=>$precios,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$proveedores = DB::table('tproveedor')->where('estado','=','1')->get();
    	$productos = DB::table('tproductoproveedor')->where('estado','=','1')->get();
    	$colaboradores = DB::table('tcolaborador')->where('estado','=','1')->get();
    	return view("precioProductoProveedor.create",["colaboradores"=>$colaboradores, "productos"=>$productos, "proveedores"=>$proveedores]);        
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(PrecioProductoProveedorFormRequest $request){
    	$precios = new PrecioProductoProveedor();
    	$mytime = Carbon::now('America/Lima');

        $precios->codiCola = $request->get('txt_codiCola');
    	$precios->codiProducProveedor = $request->get('txt_codiProducProveedor');
    	$precios->codiProveedor = $request->get('txt_codiProveedor');
    	$precios->precioProducDolar = $request->get('txt_precioProducDolar');
    	$precios->stockProduc = $request->get('txt_stockProduc');
    	$precios->tiempoEntreProduc = $request->get('txt_tiempoEntreProduc');
    	$precios->fechaConsulProduc = $mytime->toDateTimeString();
    	$precios->estado = '1';
    	
    	$precios->save();

    	return Redirect::to('precioProductoProveedor');
    }

    public function show($codi){
    	return view('precioProductoProveedor.show',["precio"=>PrecioProductoProveedor::findOrFail($codi)]);
    }

    public function edit($codi){
    	$proveedores = DB::table('tproveedor')->where('estado','=','1')->get();
    	$productos = DB::table('tproductoproveedor')->where('estado','=','1')->get();    	
        return view('precioProductoProveedor.edit',["precio"=>PrecioProductoProveedor::findOrFail($codi), "productos"=>$productos, "proveedores"=>$proveedores]);
    }

    public function update(PrecioProductoProveedorFormRequest $request, $codi){
    	$precios = PrecioProductoProveedor::findOrFail($codi);

    	$precios->codiCola = $request->get('txt_codiCola');
    	$precios->codiProducProveedor = $request->get('txt_codiProducProveedor');
    	$precios->codiProveedor = $request->get('txt_codiProveedor');
    	$precios->precioProducDolar = $request->get('txt_precioProducDolar');
    	$precios->stockProduc = $request->get('txt_stockProduc');
    	$precios->tiempoEntreProduc = $request->get('txt_tiempoEntreProduc');
    	$precios->fechaConsulProduc = $request->get('txt_fechaConsulProduc');
    	$precios->estado = '1';
    	
    	$precios->update();

    	return Redirect::to('precioProductoProveedor');
    }

    public function destroy($codi){
    	$precios = PrecioProductoProveedor::findOrFail($codi);
    	$precios->estado = '0';
    	$precios->update();
    	return Redirect::to('precioProductoProveedor');
    }
}
