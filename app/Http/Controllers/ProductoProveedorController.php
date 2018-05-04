<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\ProductoProveedor;//hacemos referencia al modelo
use appComercial\Http\Requests\ProductoProveedorFormRequest;
use appComercial\Custom\MyClass;//clase para generar las pk
use DB;

class ProductoProveedorController extends Controller
{
    public function __construct(){
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$prodProv = DB::table('tproductoproveedor as pp')
            ->join('tmarcaproducto as mp','pp.codiMarca','=','mp.codiMarca')
            ->select('pp.codiProducProveedor','mp.nombreMarca as Marca','pp.nombreProducProveedor','pp.nombreBreveProducP','pp.codiProducMarca','pp.codInterno','pp.descripProduc','pp.estado')//campos a mostrar de la unión
            ->where('nombreProducProveedor','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('nombreProducProveedor','desc')
    		->paginate(5);
    		return view('productosProveedor.index',["productosProv"=>$prodProv,"searchText"=>$query]);
    	}
    }

    public function create(){
    	$marcas = DB::table('tmarcaproducto')->where('estaMarca','=','1')->get();
    	return view("productosProveedor.create",["marcas"=>$marcas]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ProductoProveedorFormRequest $request){
    	$prodProv = new ProductoProveedor();
        $pk = new MyClass();

        $prodProv->codiProducProveedor = $pk->pk_generator("PP");
    	$prodProv->codiMarca = $request->get('txt_codiMarca');
    	$prodProv->nombreProducProveedor = $request->get('txt_nombreProducProveedor');
    	$prodProv->nombreBreveProducP = $request->get('txt_nombreBreveProducP');
    	$prodProv->codiProducMarca = $request->get('txt_codiProducMarca');
    	$prodProv->codInterno = $request->get('txt_codInterno');
    	$prodProv->descripProduc = $request->get('txt_decripProduc');
    	$prodProv->estado = '1';

    	$prodProv->save();

    	return Redirect::to('productosProveedor');
    }

    public function show($codiProdProv){
    	return view('productosProveedor.show',["productosProv"=>ProductoProveedor::findOrFail($codiProdProv)]);
    }

    public function edit($codiProdProv){
    	$marcas = DB::table('tmarcaproducto')->where('estaMarca','=','1')->get();
        return view('productosProveedor.edit',["productosProv"=>ProductoProveedor::findOrFail($codiProdProv),"marcas"=>$marcas]);
    }

    public function update(ProductoProveedorFormRequest $request, $codiProdProv){
    	$prodProv = ProductoProveedor::findOrFail($codiProdProv);

    	$prodProv->codiMarca = $request->get('txt_codiMarca');
    	$prodProv->nombreProducProveedor = $request->get('txt_nombreProducProveedor');
    	$prodProv->nombreBreveProducP = $request->get('txt_nombreBreveProducP');
    	$prodProv->codiProducMarca = $request->get('txt_codiProducMarca');
    	$prodProv->codInterno = $request->get('txt_codInterno');
    	$prodProv->descripProduc = $request->get('txt_decripProduc');
    	$prodProv->estado = '1';
    	
    	$prodProv->update();

    	return Redirect::to('productosProveedor');
    }

    public function destroy($codiProdProv){
    	$prodProv = ProductoProveedor::findOrFail($codiProdProv);
    	$prodProv->estado = '0';
    	$prodProv->update();
    	return Redirect::to('productosProveedor');
    }
}
