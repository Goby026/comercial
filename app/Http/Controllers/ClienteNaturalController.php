<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\ClienteNatural;//hacemos referencia al modelo
use appComercial\Http\Requests\ClienteNaturalFormRequest;
use appComercial\Custom\MyClass;
use DB;

class ClienteNaturalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$ClientesNaturales = DB::table('tclientenatural')
    		->where('nombreClienNatu','LIKE','%'.$query.'%')
            ->where('estado','=',1)
    		->orderBy('fechaRegisClien','desc')
    		->paginate(5);
    		return view('clientesNaturales.index',["ClientesNaturales"=>$ClientesNaturales,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("clientesNaturales.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ClienteNaturalFormRequest $request){
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
    	
    	// PARA REGISTRAR IMAGENES
    	// if (Input::hasFile('txt_imagen')) {
    	// 	$file=file('txt_imagen');
    	// 	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    	// 	$ClienteNatural->imgClienJuri = $file->getClientOriginalName();
    	// }

    	$ClienteNatural->save();

    	return Redirect::to('clientesNaturales');
    }

    public function show($codiClienteNatural){
    	return view('clientesNaturales.show',["ClientesNaturales"=>ClienteNatural::findOrFail($codiClienteNatural)]);
    }

    public function edit($codiClienteNatural){        
        return view('clientesNaturales.edit',["ClientesNaturales"=>ClienteNatural::findOrFail($codiClienteNatural)]);
    }

    public function update(ClienteNaturalFormRequest $request,$codiClienteNatural){
    	$ClienteNatural = ClienteNatural::findOrFail($codiClienteNatural);

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
        
    	$ClienteNatural->update();

    	return Redirect::to('clientesNaturales');
    }

    public function destroy($codiClienteNatural){
    	$ClienteNatural = ClienteNatural::findOrFail($codiClienteNatural);
    	$ClienteNatural->estado = '0';
    	$ClienteNatural->update();
    	return Redirect::to('clientesNaturales');
    }
}
