<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\MarcaProducto;//hacemos referencia al modelo
use appComercial\Http\Requests\MarcaProductoFormRequest;
//use Carbon\Carbon;//para poder manejar formato de zona horaria
use appComercial\Custom\MyClass;
use DB;

class MarcaProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$marcaProducto = DB::table('tmarcaproducto')->where('nombreMarca','LIKE','%'.$query.'%')
    		->where('estaMarca','=','1')
    		->orderBy('nombreMarca','desc')
    		->paginate(5);
    		return view('marcaProducto.index',["marcasProductos"=>$marcaProducto,"searchText"=>$query]);
    	}
    }

    public function getMarca(Request $request){
        $param = $request->get('name');
        $marca = DB::table('tmarcaproducto as m')
            ->select('m.nombreMarca')
            ->where('m.nombreMarca','LIKE','%'.$param.'%')->distinct()
            ->take(10)->get();

        return $marca;
    }

    public function create(){
    	return view("marcaProducto.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(MarcaProductoFormRequest $request){
    	$marcaProducto = new MarcaProducto();
        $pk = new MyClass();

        $marcaProducto->codiMarca = $pk->pk_generator("MP");
    	$marcaProducto->nombreMarca = $request->get('txt_nombreMarca');
    	$marcaProducto->nombreBreveMarca = $request->get('txt_nombreBreveMarca');
    	$marcaProducto->estaMarca = '1';

    	if (Input::hasFile('txt_imagenMarca')) {//fuente https://www.youtube.com/watch?v=sxs_7nm2BKE&list=PLZPrWDz1MolrxS1uw-u7PrnK66DCFmhDR&index=11 minuto:5
    		$file = Input::file('txt_imagenMarca');
    		$file->move(public_path().'/imagenes/marcas/',$file->getClientOriginalName());
    		$marcaProducto->imagenMarca = $file->getClientOriginalName();
    	}

    	$marcaProducto->save();

    	return Redirect::to('marcaProducto');
    }

    public function show($codiMarca){
    	return view('marcaProducto.show',["marcasProductos"=>MarcaProducto::findOrFail($codiMarca)]);
    }

    public function edit($codiMarca){
        return view('marcaProducto.edit',["marcasProductos"=>MarcaProducto::findOrFail($codiMarca)]);
    }

    public function update(MarcaProductoFormRequest $request, $codiMarca){
    	$marcaProducto = MarcaProducto::findOrFail($codiMarca);
    	$marcaProducto->nombreMarca = $request->get('txt_nombreMarca');
    	$marcaProducto->nombreBreveMarca = $request->get('txt_nombreBreveMarca');

    	if (Input::hasFile('txt_imagenMarca')) {//fuente https://www.youtube.com/watch?v=sxs_7nm2BKE&list=PLZPrWDz1MolrxS1uw-u7PrnK66DCFmhDR&index=11 minuto:5
    		$file =  Input::file('txt_imagenMarca');
    		$file->move(public_path().'/imagenes/marcas/',$file->getClientOriginalName());
    		$marcaProducto->imagenMarca = $file->getClientOriginalName();
    	}

    	$marcaProducto->estaMarca = '1';
    	$marcaProducto->update();

    	return Redirect::to('marcaProducto');
    }

    public function destroy($codiMarca){
    	$marcaProducto = MarcaProducto::findOrFail($codiMarca);
    	$marcaProducto->estaMarca = '0';
    	$marcaProducto->update();
    	return Redirect::to('marcaProducto');
    }

}
