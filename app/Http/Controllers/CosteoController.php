<?php

namespace appComercial\Http\Controllers;

use appComercial\Costeo;
use appComercial\Custom\MyClass;
use appComercial\Dolar;
use appComercial\Http\Controllers\Api\ApiController;
use appComercial\Igv;
use Carbon\Carbon;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use DB;
use Illuminate\Support\Facades\Auth;

class CosteoController extends ApiController
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $clientes = DB::table('tclientejuridico')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
    	return view('cotizaciones.index',["clientes"=>$clientes]);
    }

    public function create(){
    	return "create";
    }

    public function store(Request $request){
        $data = [];

        $pk = new MyClass();

        $mytime = Carbon::now('America/Lima');

        $costeo = new Costeo();
        $costeo->codiCosteo = $pk->pk_generator("COS");
        $costeo->fechaIniCosteo = $mytime->toDateTimeString();
        $costeo->fechaFinCosteo = null;
        $costeo->costoTotalDolares = 0.0;
        $costeo->costoTotalSoles = 0.0;
        $costeo->totalVentaSoles = 0.0;
        $costeo->utilidadVentaSoles = 0.0;
        $costeo->margenCosto = 1.35;
        $costeo->margenVenta = 0.0;
        $costeo->codiCosteoEsta = "CE_23_7_201851103826117134912";
        $costeo->codiCola = Auth::user()->codiCola;
        $costeo->codiIgv = null;
        $costeo->codiDolar = null;
        $costeo->tipoCosteo = 0;
        $costeo->currency = 0;
        $costeo->mostrarTotal = 0;
        $costeo->cantiPc = 0;
        $costeo->totalPartes = 0;
        $costeo->utiPartes = 0;
        $costeo->margenPartes = 0;
        $costeo->detalle = "";
        $costeo->imagen = "";

        $costeo->save();

        $data['costeo'] = $costeo;

        return $this->sendResponse($data, "Costeo registrado correctamente");

    }

    public function show($id){
    	return $id;
    }

    public function getCosteo($id){
        $data = [];

        $costeo = Costeo::find($id);

        $data['tcosteo'] = $costeo;

        return $this->sendResponse($data, "Entidad Costeo recuperada correctamente");
    }

    public function edit($id){
        return $id;
    }

    public function update(Request $request, $id){

        //actualizar solo los campos de las partes
        $data = [];

        $costeo = Costeo::find($id);

        $costeo->cantiPc = $request->get('cantiPc');
        $costeo->totalPartes = $request->get('totalPS');
        $costeo->utiPartes = $request->get('totalUtilidad');
        $costeo->margenPartes = $request->get('totalMargen');
        $costeo->detalle = $request->get('detalle');
        $costeo->imagen = $request->get('imagen');

//        sumar el total de la cotizacion
        $costeo->totalVentaSoles += ($request->get('totalPS') * $request->get('cantiPc'));
//        $costeo->utilidadVentaSoles = $request->get('txt_utilidadTotal');
//        $costeo->margenVenta = $request->get('txt_margenTotal');


        $costeo->update();

        $data['costeo'] = $costeo;

    	return $this->sendResponse($data,"Se actualizó el costeo de PC");
    }

    public function destroy($id){
    	return $id;
    }

    public function getData(){
        $data = [];

        $dolar = Dolar::all()->last();
        $igv = Igv::all()->last();

        $data['dolar'] = $dolar;
        $data['igv'] = $igv;

        return $this->sendResponse($data, "Datos para hacer cálculos en un costeo");
    }

    public function uploadFile(Request $request){
        $data = [];

        //SUBIR LA IMAGEN AL SERVIDOR
        if ($request->hasFile('image')) {
            $imagen = $request->image->getClientOriginalName();
            $data['imagen'] = $imagen;
//            $request->image->store('public/img', $imagen);
            $request->image->move(public_path().'/img',$imagen);
        }

//        ACTUALIZA EL CAMPO DE IMAGEN DE LA BASE DE DATOS

        $costeo = Costeo::find($request->get('codiCosteo'));

        $costeo->imagen = $imagen;

        $costeo->update();

        $data['costeo'] = $costeo;

        return $this->sendResponse($data, "Se registró la imagen");
    }
}
