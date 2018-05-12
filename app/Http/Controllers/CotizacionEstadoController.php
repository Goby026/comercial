<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\CotizacionEstado;//hacemos referencia al modelo
use appComercial\Http\Requests\CotizacionEstadoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CotizacionEstadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$cotizacionEstados = DB::table('tcotizacionestado')->where('nombreCotiEsta','LIKE','%'.$query.'%')
    		->where('estaCotiEsta','=','1')
    		->orderBy('nombreCotiEsta','desc')
    		->paginate(5);
    		return view('cotizacionEstados.index',["cotizacionEstados"=>$cotizacionEstados,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("cotizacionEstados.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CotizacionEstadoFormRequest $request){
    	$cotizacionEstado = new CotizacionEstado();
        $pk = new MyClass();

        $cotizacionEstado->codiCotiEsta = $pk->pk_generator("CE");
        $cotizacionEstado->nombreCotiEsta = $request->get('txt_nombreCotiEsta');
    	$cotizacionEstado->nombreBreveCotiEsta = $request->get('txt_nombreBreveCotiEsta');
    	$cotizacionEstado->ordenCotiEsta = $request->get('txt_ordenCotiEsta');
    	$cotizacionEstado->estaCotiEsta = '1';
    	
    	$cotizacionEstado->save();

    	return Redirect::to('cotizacionEstados');
    }

    public function show($codiCotiEsta){
    	return view('cotizacionEstados.show',["cotizacionEstado"=>CotizacionEstado::findOrFail($codiCotiEsta)]);
    }

    public function edit($codiCotiEsta){
        return view('cotizacionEstados.edit',["cotizacionEstado"=>CotizacionEstado::findOrFail($codiCotiEsta)]);
    }

    public function update(CotizacionEstadoFormRequest $request, $codiCotiEsta){
    	$cotizacionEstado = CotizacionEstado::findOrFail($codiCotiEsta);

    	$cotizacionEstado->nombreCotiEsta = $request->get('txt_nombreCotiEsta');
    	$cotizacionEstado->nombreBreveCotiEsta = $request->get('txt_nombreBreveCotiEsta');
    	$cotizacionEstado->ordenCotiEsta = $request->get('txt_ordenCotiEsta');
    	$cotizacionEstado->estaCotiEsta = '1';
    	
    	$cotizacionEstado->update();

    	return Redirect::to('cotizacionEstados');
    }

    public function destroy($codiCotiEsta){
    	$cotizacionEstado = CotizacionEstado::findOrFail($codiCotiEsta);
    	$cotizacionEstado->estaCotiEsta = '0';
    	$cotizacionEstado->update();
    	return Redirect::to('cotizacionEstados');
    }
}
