<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\ContactoCliente;//hacemos referencia al modelo
use appComercial\Http\Requests\ContactoClienteFormRequest;
use appComercial\Custom\MyClass;
use Carbon\Carbon;
use DB;

class ContactoClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$contactosCliente = DB::table('tcontactocliente')
    		->where('nombreContacClien','LIKE','%'.$query.'%')
            ->where('estado','=',1)
    		->orderBy('fechaRegisContacClien','desc')
    		->paginate(5);
    		return view('contactosCliente.index',["contactosCliente"=>$contactosCliente,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("contactosCliente.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(Request $request){
    	$contactoCliente = new ContactoCliente();
        $mytime = Carbon::now('America/Lima');
        $pk = new MyClass();

        $contactoCliente->codiContacClien = $pk->pk_generator("CC");
    	$contactoCliente->apePaterContacC = $request->get('txt_apePaterContacC');
    	$contactoCliente->apeMaterContacC = $request->get('txt_apeMaterContacC');
    	$contactoCliente->nombreContacClien = $request->get('txt_nombreContacClien');
    	$contactoCliente->correoContacClien = $request->get('txt_correoContacClien');
    	$contactoCliente->direcContacClien = $request->get('txt_direcContacClien');
    	$contactoCliente->codiDistri = $request->get('txt_codiDistri');
    	$contactoCliente->codiProvin = $request->get('txt_codiProvin');
    	$contactoCliente->codiDepar = $request->get('txt_codiDepar');
    	$contactoCliente->celu01ContacClien = $request->get('txt_celu01ContacClien');
    	$contactoCliente->celu02ContacClien = $request->get('txt_celu02ContacClien');
    	$contactoCliente->teleContacClien = $request->get('txt_teleContacClien');
    	$contactoCliente->aneContacClien = $request->get('txt_aneContacClien');
    	$contactoCliente->fechaRegisContacClien = $mytime->toDateTimeString();
    	$contactoCliente->codiClienJuri = $request->get('txt_codiClienJuri');
    	$contactoCliente->codiCola = $request->get('txt_codiCola');
    	$contactoCliente->estado = '1';

        $contactoCliente->save();
    	
    	// PARA REGISTRAR IMAGENES
    	// if (Input::hasFile('txt_imagen')) {
    	// 	$file=file('txt_imagen');
    	// 	$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    	// 	$contactoCliente->imgClienJuri = $file->getClientOriginalName();
    	// }

        if ($request->get('txt_opcion') !="") {
            echo 1;
        }else{
    	   return Redirect::to('contactosCliente');
        }

    }

    public function show($codiClienteNatural){
    	return view('contactosCliente.show',["contactoCliente"=>ContactoCliente::findOrFail($codiClienteNatural)]);
    }

    public function edit($codiClienteNatural){
        return view('contactosCliente.edit',["contactoCliente"=>ContactoCliente::findOrFail($codiClienteNatural)]);
    }

    public function update(ContactoClienteFormRequest $request,$codiClienteNatural){
    	$contactoCliente = ContactoCliente::findOrFail($codiClienteNatural);

    	$contactoCliente->apePaterContacC = $request->get('txt_apePaterContacC');
    	$contactoCliente->apeMaterContacC = $request->get('txt_apeMaterContacC');
    	$contactoCliente->nombreContacClien = $request->get('txt_nombreContacClien');
    	$contactoCliente->correoContacClien = $request->get('txt_correoContacClien');
    	$contactoCliente->direcContacClien = $request->get('txt_direcContacClien');
    	$contactoCliente->codiDistri = $request->get('txt_codiDistri');
    	$contactoCliente->codiProvin = $request->get('txt_codiProvin');
    	$contactoCliente->codiDepar = $request->get('txt_codiDepar');
    	$contactoCliente->celu01ContacClien = $request->get('txt_celu01ContacClien');
    	$contactoCliente->celu02ContacClien = $request->get('txt_celu02ContacClien');
    	$contactoCliente->teleContacClien = $request->get('txt_teleContacClien');
    	$contactoCliente->aneContacClien = $request->get('txt_aneContacClien');
    	$contactoCliente->fechaRegisContacClien = $request->get('fechaRegisContacClien');
    	$contactoCliente->codiClienJuri = $request->get('txt_codiClienJuri');
    	$contactoCliente->codiCola = $request->get('txt_codiCola');
    	$contactoCliente->estado = '1';
        
    	$contactoCliente->update();

    	return Redirect::to('contactosCliente');
    }

    public function destroy($codiClienteNatural){
    	$contactoCliente = ContactoCliente::findOrFail($codiClienteNatural);
    	$contactoCliente->estado = '0';
    	$contactoCliente->update();
    	return Redirect::to('contactosCliente');
    }
}
