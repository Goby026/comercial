<?php

namespace appComercial\Http\Controllers;

use appComercial\CosteoItem;
use appComercial\CotiCosteo;
use appComercial\Cotizacion;
use appComercial\Dolar;
use appComercial\Http\Controllers\Api\ApiController;
use appComercial\Proveedor;
use Carbon\Carbon;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;//referencia a Redirect para hacer las redirecciones
//use Illuminate\Support\Facades\Input;//para poder subir imagenes al servidor
use appComercial\Costeo;//hacemos referencia al modelo
use appComercial\Http\Requests\CosteoFormRequest;
use appComercial\Custom\MyClass;
use DB;

class CosteoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $clientes = DB::table('tclientejuridico')->where('estado', '=', '1')->get();//obtener los clientes jur. ACTIVOS
        return view('cotizaciones.index', ["clientes" => $clientes]);
    }

    public function getData($codiCoti)
    {

        $costeos = DB::select("select * from tcotizacion c
inner join tcoticosteo cc on c.codiCoti = cc.codiCoti
inner join tcosteo cos on cc.codiCosteo = cos.codiCosteo
where c.codiCoti = '$codiCoti' ");

        $proveedores = Proveedor::all();

        $data['costeos'] = $costeos;
        $data['proveedores'] = $proveedores;

        return $this->sendResponse($data, "Conjunto de datos para frontend");
    }

    public function store(Request $request)
    {
        $data = [];
        $pk = new MyClass();
        $mytime = Carbon::now('America/Lima');

        $cotizacion = Cotizacion::findOrFail($request->get('codiCoti'));

        //registrar nuevo costeo con la misma cotizacion
        $costeo = new Costeo();
        $costeo->codiCosteo = $pk->pk_generator("COS");
        $costeo->fechaIniCosteo = $mytime->toDateTimeString();
        $costeo->fechaFinCosteo = "";
        $costeo->title = "";
        $costeo->cantidad = 1;
        $costeo->descCosteo = "";
        $costeo->costoTotalDolares = "";
        $costeo->costoTotalSoles = "";
        $costeo->totalVentaSoles = "";
        $costeo->utilidadVentaSoles = "";
        $costeo->margenCosto = "";
        $costeo->margenVenta = "";
        $costeo->codiCosteoEsta = "CE_23_7_201851103826117134912";
        $costeo->codiCola = Auth::user()->codiCola;
        $costeo->codiIgv = "";
        $costeo->codiDolar = "";
        $costeo->tipoCosteo = $request->get('tipoCosteo');
        $costeo->currency = "";
        $costeo->mostrarTotal = "";

        $costeo->save();

        //registrar nuevo coticosteo con el nuevo costeo

        $cotiCosteo = new CotiCosteo();

        $cotiCosteo->codiCosteo = $costeo->codiCosteo;
        $cotiCosteo->codiCoti = $cotizacion->codiCoti;
        $cotiCosteo->codiCola = Auth::user()->codiCola;
        $cotiCosteo->estado = 1;

        $cotiCosteo->save();

        //registrar nuevo CosteoItem

        $costeoItem = new CosteoItem();
        $costeoItem->codiCosteo = $costeo->codiCosteo;
        $costeoItem->idTPrecioProductoProveedor = 1;
        $costeoItem->itemCosteo = '.';
        $costeoItem->descCosteoItem = '.';
        $costeoItem->fechaCosteoIni = $mytime->toDateTimeString();
        $costeoItem->cantiCoti = 1;
        $costeoItem->precioProducDolar = 0.0;
        $costeoItem->costoUniIgv = 0.0;
        $costeoItem->costoTotalIgv = 0.0;
        $costeoItem->costoUniSolesIgv = 0.0;
        $costeoItem->costoTotalSolesIgv = 0.0;
        $costeoItem->precioUniSoles = 0.0;
        $costeoItem->precioTotal = 0.0;
        $costeoItem->margenCoti = 1.35;
        $costeoItem->utiCoti = 0.0;
        $costeoItem->margenVentaCoti = 1.3;
        $costeoItem->liquidacion = 0.0;
        $costeoItem->fechaCosteoActu = $mytime->toDateTimeString();
        $costeoItem->numPack = 1;
        $costeoItem->codiProveeContac = 'PC_23_7_201897114126182531013';
        $costeoItem->imagen = "";
        $costeoItem->codiProveedor = null;
        $costeoItem->codInterno = "";
        $costeoItem->codProveedor = null;
        $costeoItem->tipoItem = 0;
        $costeoItem->estado = 1;

        $costeoItem->save();

        $data['costeo'] = $costeo;
        $data['cotiCosteo'] = $cotiCosteo;
        $data['costeoItem'] = $costeoItem;

        return $this->sendResponse($data, "Se registró nuevo costeo");
    }

    public function updateCosteo(Request $request){

        $costeo = Costeo::findOrFail($request->get('codiCosteo'));

        $costeo->title = $request->get('title');

        $costeo->update();

        $data['costeo'] = $costeo;

        return $this->sendResponse($data, "Costeo actualizado");
    }

    public function update(Request $request)
    {
        $item = $request->input('item');
//        $codiProveedor = $request->input('codiProveedor');
        $data = [];

//        actualizar el itemcosteo
        $costeoItem = CosteoItem::findOrFail($item['idCosteoItem']);
        $costeoItem->itemCosteo = $item['itemCosteo'];
        $costeoItem->descCosteoItem = $item['descCosteoItem'];
        $costeoItem->cantiCoti = $item['cantiCoti'];
        $costeoItem->precioProducDolar = $item['precioProducDolar'];
        $costeoItem->costoUniIgv = $item['costoUniIgv'];
        $costeoItem->costoTotalIgv = $item['costoTotalIgv'];
        $costeoItem->costoUniSolesIgv = $item['costoUniSolesIgv'];
        $costeoItem->costoTotalSolesIgv = $item['costoTotalSolesIgv'];
        $costeoItem->precioUniSoles = $item['precioUniSoles'];
        $costeoItem->precioTotal = $item['precioTotal'];
        $costeoItem->margenCoti = $item['margenCoti'];
        $costeoItem->utiCoti = $item['utiCoti'];
        $costeoItem->margenVentaCoti = $item['margenVentaCoti'];
        $costeoItem->liquidacion = $item['liquidacion'];
        $costeoItem->fechaCosteoActu = $item['fechaCosteoActu'];
        $costeoItem->numPack = $item['numPack'];
        $costeoItem->imagen = $item['imagen'];
        $costeoItem->codiProveedor = $item['codiProveedor'];
        $costeoItem->codInterno = $item['codInterno'];
        $costeoItem->codProveedor = $item['codProveedor'];
        $costeoItem->tipoItem = $item['tipoItem'];
        $costeoItem->estado = $item['estado'];

        $costeoItem->update();


//        seteando los datos
//        $variable = $item['codInterno'];
//        $variable = $item['codProveedor'];
//        $variable = $item['codiClien'];
//        $variable = $item['codiCola'];
//        $variable = $item['codiContacClien'];
//        $variable = $item['codiCosteo'];
//        $variable = $item['codiCosteoEsta'];
//        $variable = $item['codiCoti'];
//        $variable = $item['codiCotiEsta'];
//        $variable = $item['codiDolar'];
//        $variable = $item['codiIgv'];
//        $variable = $item['codiProveeContac'];
//        $variable = $item['codiProveedor'];
//        $variable = $item['codiTipoCliente'];
//        $variable = $item['costoTotalDolares'];
//        $variable = $item['costoTotalIgv'];
//        $variable = $item['costoTotalSoles'];
//        $variable = $item['costoTotalSolesIgv'];
//        $variable = $item['costoUniIgv'];
//        $variable = $item['costoUniSolesIgv'];
//        $variable = $item['currency'];
//        $variable = $item['estado'];
//        $variable = $item['fechaCosteoActu'];
//        $variable = $item['fechaCosteoIni'];
//        $variable = $item['fechaCoti'];
//        $variable = $item['fechaFinCosteo'];
//        $variable = $item['fechaIniCosteo'];
//        $variable = $item['fechaSistema'];
//        $variable = $item['idCosteoItem'];
//        $variable = $item['idTCotiCosteo'];
//        $variable = $item['idTPrecioProductoProveedor'];
//        $variable = $item['imagen'];
//        $variable = $item['liquidacion'];
//        $variable = $item['margenCosto'];
//        $variable = $item['margenCoti'];
//        $variable = $item['margenVenta'];
//        $variable = $item['margenVentaCoti'];
//        $variable = $item['margen_condi'];
//        $variable = $item['margen_firma'];
//        $variable = $item['mostrarTotal'];
//        $variable = $item['nomCli'];
//        $variable = $item['nomContac'];
//        $variable = $item['numCoti'];
//        $variable = $item['numPack'];
//        $variable = $item['precioTotal'];
//        $variable = $item['precioUniSoles'];
//        $variable = $item['referencia'];
//        $variable = $item['tiemCoti'];
//        $variable = $item['tipoCosteo'];
//        $variable = $item['tipoItem'];
//        $variable = $item['totalVentaSoles'];
//        $variable = $item['utiCoti'];
//        $variable = $item['utilidadVentaSoles'];

//        $data['costeoItem'] = $costeoItem;


        return $this->sendResponse($data, "Se actualizó el costeoItem: ".$item['idCosteoItem']);
    }

    public function destroy($codiCosteo)
    {
        $costeo = Costeo::findOrFail($codiCosteo);

        $data['costeo'] = $costeo;

        $costeo->delete();

        return $this->sendResponse($data, "Datos del costeo borrado");
    }

    public function getCosteos($codiCoti){

        $costeos = DB::select("select * from tcosteo cos
inner join tcoticosteo cc on cos.codiCosteo = cc.codiCosteo
inner join tcotizacion c on c.codiCoti = cc.codiCoti
where c.codiCoti = '".$codiCoti."' ");

        $items = DB::select("select * from tcosteoitem ci
inner join tcosteo cos on ci.codiCosteo = cos.codiCosteo
inner join tcoticosteo cc on cos.codiCosteo = cc.codiCosteo
where cc.codiCoti = '".$codiCoti."' ");

        $data['costeos'] = $costeos;
        $data['items'] = $items;

        return $this->sendResponse($data, "COSTEOS -> KIT - PRODUCTOS");
    }
}
