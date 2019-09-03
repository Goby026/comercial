<?php

namespace appComercial\Http\Controllers;

use appComercial\Costeo;
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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return "HOLA COSTEO-ITEM";
    }

    public function getItems($codiCoti)
    {
        $items = DB::select("select * from tcotizacion c
inner join tcoticosteo cc on c.codiCoti = cc.codiCoti
inner join tcosteo cos on cc.codiCosteo = cos.codiCosteo
inner join tcosteoitem ci on cos.codiCosteo = ci.codiCosteo
where c.codiCoti = '$codiCoti'");

        $prods = DB::select("select * from tcotizacion c
inner join tcoticosteo cc on c.codiCoti = cc.codiCoti
inner join tcosteo cos on cc.codiCosteo = cos.codiCosteo
inner join tcosteoitem ci on cos.codiCosteo = ci.codiCosteo
where c.codiCoti = '$codiCoti' and cos.tipoCosteo = 0 ");

        $data['items'] = $items;
        $data['prods'] = $prods;

        return $this->sendResponse($data, "Items de la cotización: " . $codiCoti);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

    }

    // public function addCosteoItem($codiCoti){
    public function addCosteoItem(Request $request)
    {
        $mytime = Carbon::now('America/Lima');

        $costeoItem = new CosteoItem();
        $costeoItem->codiCosteo = $request->get('codiCosteo');
        $costeoItem->idTPrecioProductoProveedor = 1;
        $costeoItem->itemCosteo = "";
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
        $costeoItem->numPack = 1;
        $costeoItem->codiProveeContac = null;
        $costeoItem->imagen = "";
        $costeoItem->codiProveedor = "";
        $costeoItem->codInterno = "";
        $costeoItem->codProveedor = "";
        $costeoItem->tipoItem = 0;//prod o servicio
        $costeoItem->estado = 1;

        $costeoItem->save();

        $data['costeoItem'] = $costeoItem;

        return $this->sendResponse($data, "Item de kit registrado codiCosteo: " . $request->get('codiCosteo'));

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

//    	return view('nuevaCotizacion.edit',["SedeJuridico"=>$SedeJuridico, "clientesJuridico"=>$clientesJuridico]);
    }

    public function update(Request $request)
    {
        $data = [];

        $item = CosteoItem::find($request->input('idCosteoItem'));
        $descCosteoItem = $request->input('descCosteoItem');

        if (is_object($item)) {

            $item->descCosteoItem = $descCosteoItem;

            $item->update();

            $data['costeoItem'] = $item;

            return $this->sendResponse($data, "costeoItem actualizado");
        } else {

            $costeo = Costeo::find($request->input('idCosteoItem'));

            $costeo->descCosteo = $descCosteoItem;

            $costeo->update();

            $data['costeo'] = $costeo;

            return $this->sendResponse($data, "Costeo actualizado");
        }

    }

    public function delCosteoItem($id)
    {
        $item = CosteoItem::findOrFail($id);

        $item->delete();

        $data['itemDeleted'] = $item;

        return $this->sendResponse($data, "Item eliminado");
    }

    //metodo para autocompletar el campo Producto
    public function getProductoCoti(Request $request)
    {
        $param = $request->get('name');
        $productos = DB::table('tcosteoitem as c')
            ->select('c.itemCosteo')
            ->where('c.itemCosteo', 'LIKE', '%' . $param . '%')->distinct()
            ->take(10)->get();
        return $productos;
    }
}
