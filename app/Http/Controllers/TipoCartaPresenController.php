<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\TipoCartaPresen;//hacemos referencia al modelo
use appComercial\Http\Requests\TipoCartaPresenFormRequest;
use appComercial\Custom\MyClass;
use DB;

class TipoCartaPresenController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$tipoCarta = DB::table('ttipocartapresen')->where('nombreTipoCartaP','LIKE','%'.$query.'%')
    		->where('estaTipoCartaPresen','=','1')
    		->orderBy('nombreTipoCartaP','desc')
    		->paginate(5);
    		return view('tipoCartaPresen.index',["tipoCartas"=>$tipoCarta,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("tipoCartaPresen.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(TipoCartaPresenFormRequest $request){
    	$tipoCartaPresen = new TipoCartaPresen();
        $pk = new MyClass();

        $tipoCartaPresen->codiTipoCartaPresen = $pk->pk_generator("TCP");
        $tipoCartaPresen->tipoCartaPresen = $request->get('txt_tipoCartaPresen');
    	$tipoCartaPresen->nombreTipoCartaP = $request->get('txt_nombreTipoCartaP');
    	$tipoCartaPresen->nombreBreveTipoCartaP = $request->get('txt_nombreBreveTipoCartaP');
    	$tipoCartaPresen->estaTipoCartaPresen = '1';
    	
    	$tipoCartaPresen->save();

    	return Redirect::to('tipoCartaPresen');
    }

    public function show($codiTipoCarta){
    	return view('tipoCartaPresen.show',["tipoCartas"=>TipoCartaPresen::findOrFail($codiTipoCarta)]);
    }

    public function edit($codiTipoCarta){
        return view('tipoCartaPresen.edit',["tipoCartas"=>TipoCartaPresen::findOrFail($codiTipoCarta)]);
    }

    public function update(TipoCartaPresenFormRequest $request, $codiTipoCarta){
    	$tipoCartaPresen = TipoCartaPresen::findOrFail($codiTipoCarta);

    	$tipoCartaPresen->tipoCartaPresen = $request->get('txt_tipoCartaPresen');
    	$tipoCartaPresen->nombreTipoCartaP = $request->get('txt_nombreTipoCartaP');
    	$tipoCartaPresen->nombreBreveTipoCartaP = $request->get('txt_nombreBreveTipoCartaP');
    	$tipoCartaPresen->estaTipoCartaPresen = '1';
    	
    	$tipoCartaPresen->update();

    	return Redirect::to('tipoCartaPresen');
    }

    public function destroy($codiTipoCarta){
    	$tipoCartaPresen = TipoCartaPresen::findOrFail($codiTipoCarta);
    	$tipoCartaPresen->estaTipoCartaPresen = '0';
    	$tipoCartaPresen->update();
    	return Redirect::to('tipoCartaPresen');
    }
}
