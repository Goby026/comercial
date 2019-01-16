<?php

namespace appComercial\Http\Controllers;

use appComercial\CotiCosteo;
use appComercial\Cotizacion;
use appComercial\Http\Controllers\Api\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\CosteoItem;//hacemos referencia al modelo
use appComercial\Http\Requests\CosteoItemFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CosteoItemController extends ApiController
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	// if ($request) {
    	// 	$query = trim($request->get('searchText'));
    	// 	$SedesJuridico = DB::table('tcosteoitem as ci')
    	// 	->join('tclientejuridico as cj','sj.codiClienJuri','=','cj.codiClienJuri')
    	// 	->select('sj.codiSedeJur','sj.descSedeJur','sj.estadoSedeJur','sj.fechaSistema','cj.razonSocialClienJ as Cliente')//campos a mostrar de la unión
    	// 	->where('sj.descSedeJur','LIKE','%'.$query.'%')
     	//	->where('sj.estadoSedeJur','=',1)
    	// 	->orwhere('sj.codiSedeJur','LIKE','%'.$query.'%')//si deseamos buscar por otro parametro entonces orwhere
    	// 	->orderBy('sj.codiSedeJur','desc')
    	// 	->paginate(5);
    	// 	return view('cotizaciones.index',["SedesJuridico"=>$SedesJuridico,"searchText"=>$query]);
    	// }

    	return "HOLA COSTEO-ITEM";
    }

    public function create(){
//    	$clientesJuridico = DB::table('tcosteoitem')->where('estado','=','1')->get();//obtener los clientes jur. ACTIVOS
//    	return view("nuevaCotizacion.create",["clientesJuridico"=>$clientesJuridico]);
    }

    public function store(Request $request){

        $data = [];

        $costeoItem = new CosteoItem();

        $costeoItem->idTPrecioProductoProveedor = $request->get('idTPrecioProductoProveedor');
        $costeoItem->itemCosteo = '';
        $costeoItem->descCosteoItem = '';
        $costeoItem->fechaCosteoIni = '';
        $costeoItem->cantiCoti = 1;
        $costeoItem->precioProducDolar = 0.0;
        $costeoItem->costoUniIgv = 0.0;
        $costeoItem->costoTotalIgv = 0.0;
        $costeoItem->costoUniSolesIgv = 0.0;
        $costeoItem->costoTotalSolesIgv = 0.0;
        $costeoItem->precioUniSoles = 0.0;
        $costeoItem->precioTotal = 0.0;
        $costeoItem->margenCoti = 0.0;
        $costeoItem->utiCoti = 0.0;
        $costeoItem->margenVentaCoti = 0.0;
        $costeoItem->liquidacion = 0.0;
        $costeoItem->fechaCosteoActu = null;
        $costeoItem->numPack = 1;
        $costeoItem->codiProveeContac = null;
        $costeoItem->imagen = '';
        $costeoItem->codInterno = '';
        $costeoItem->codProveedor = '';
        $costeoItem->tipoItem = null;
        $costeoItem->estado = 1;

        $costeoItem->save();

        $data['costeoItem'] = $costeoItem;

    	return $this->sendResponse($data, "Se registro nuevo item de costeo");
    }

    // public function addCosteoItem($codiCoti){
    public function addCosteoItem(Request $request){

        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($request->get('codiCoti'));

        $cotiCosteo = CotiCosteo::where('codiCoti',$cotizacion->codiCoti)->first();

        $costeo = CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->first();

        $numCosteos = count(CosteoItem::where('codiCosteo', $cotiCosteo->codiCosteo)->get());

        // return "Pack n°: ".$costeo->numPack;

        $costeoItem = new CosteoItem();

        $costeoItem->codiCosteo = $costeo->codiCosteo;
        $costeoItem->idTPrecioProductoProveedor = 1;
        $costeoItem->itemCosteo = '.';
        $costeoItem->descCosteoItem = "";
        $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
        $costeoItem->cantiCoti = 1;
        $costeoItem->precioProducDolar = 0.0;
        $costeoItem->costoUniIgv = 0.0;
        $costeoItem->costoTotalIgv = 0.0;
        $costeoItem->costoUniSolesIgv = 0.0;
        $costeoItem->costoTotalSolesIgv = 0.0;
        $costeoItem->precioUniSoles = 0.0;
        $costeoItem->precioTotal = 0.0;
        $costeoItem->margenCoti = 1.3;
        $costeoItem->utiCoti = 0.0;
        $costeoItem->margenVentaCoti = 0.0;
        $costeoItem->liquidacion = 0.0;
        $costeoItem->fechaCosteoActu = null;
        $costeoItem->numPack = $numCosteos + 1;
        $costeoItem->codiProveeContac = null;
        $costeoItem->imagen = "";
        $costeoItem->codiProveedor = "";
        $costeoItem->codInterno = "";
        $costeoItem->codProveedor = "";
        $costeoItem->tipoItem = 0;//prod o servicio
        $costeoItem->estado = 1;

        if ($costeoItem->save()) {
            return "1";
        }else{
            return "0";
        }
    }

    public function show($id){

    }

    public function edit($id){

//    	return view('nuevaCotizacion.edit',["SedeJuridico"=>$SedeJuridico, "clientesJuridico"=>$clientesJuridico]);
    }

    public function update(Request $request,$codiCosteoItem){

    	return Redirect::to('nuevaCotizacion');
    }

    public function delCosteoItem(Request $request){
        $codiCosteoItem = $request->get('codiCosteoItem');
        $costeoItem = CosteoItem::findOrFail($codiCosteoItem);

        if ($costeoItem->delete()) {
//        tambien se debe recibir el codigo de costeo para realizar el ciclo de actualizacion de numero de orden
//        actualizar el orden de los items costeados
            $costeosItems = CosteoItem::where('codiCosteo', '=', $request->get('codiCosteo'))->get();
            $i = 1;
            foreach ($costeosItems as $costeo) {
                $costeo->numPack = $i;
                $costeo->update();
                $i++;
            }
            return "OK";
        } else {
            return "ERROR";
        }
    }

    //metodo para autocompletar el campo Producto
    public function getProductoCoti(Request $request){
        $param = $request->get('name');
        $productos = DB::table('tcosteoitem as c')
            ->select('c.itemCosteo')
            ->where('c.itemCosteo','LIKE','%'.$param.'%')->distinct()
            ->take(10)->get();
        return $productos;
    }
}
