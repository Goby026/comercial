<?php

namespace appComercial\Http\Controllers;

use appComercial\Http\Controllers\Api\ApiController;
use appComercial\ItemParte;
use appComercial\PartePc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemParteController extends ApiController
{
    public function store(Request $request)
    {
        $data = [];
//        se necesita codiCosteo restrictivamente

        $itemParte = new ItemParte();
        $itemParte->codiCosteo = $request->get("codiCosteo");
        $itemParte->codiParte = $request->get("codiParte");
        $itemParte->codiMarca = null;
        $itemParte->descripcion = "";
        $itemParte->margencus = 0.0;
        $itemParte->cantidad = 0.0;
        $itemParte->cudsin = 0.0;
        $itemParte->cud = 0.0;
        $itemParte->totald = 0.0;
        $itemParte->cus = 0.0;
        $itemParte->totals = 0.0;
        $itemParte->pus = 0.0;
        $itemParte->total = 0.0;
        $itemParte->utilidad = 0.0;
        $itemParte->margenfinal = 0.0;

        $itemParte->save();

        $data['reg'] = $itemParte;

        return $this->sendResponse($data, "Se registraron las partes de pc");
    }

    //metodo para verificar si alguna parte ya esta en el costeo, para mostrar los botones de agregar parte
    public function checkItems(){

    }


    public function getItemPartes($codiCosteo)
    {
        $data = [];

        $itemPartes = DB::select("SELECT ip.idItemParte, ip.descripcion, p.icono, p.nombre, ip.margencus, ip.cantidad, ip.cudsin, ip.cud, ip.totald, ip.cus, ip.totals,ip.pus,ip.total,ip.utilidad,ip.margenfinal, ip.codiParte
                            FROM itemparte ip 
                            INNER JOIN  tpartepc p ON ip.codiParte = p.codiParte 
                            WHERE codiCosteo = '" . $codiCosteo . "' ");
        $data['items'] = $itemPartes;

        return $this->sendResponse($data, "Existe costeo de pc en el costeo: ".$codiCosteo);

    }

    //metodo para cuando se haga el registro de una cotizacion con partes de PC
    public function add(Request $request){

        $data = [];

        $partes = PartePc::all();

        foreach ($partes as $parte){

            $itemParte = new ItemParte();
            $itemParte->codiParte = $parte->codiParte;
            $itemParte->codiCosteo = $request->get("codiCosteo");
            $itemParte->margencus = 0.0;
            $itemParte->cantidad = 0.0;
            $itemParte->cudsin = 0.0;
            $itemParte->cud = 0.0;
            $itemParte->totald = 0.0;
            $itemParte->cus = 0.0;
            $itemParte->totals = 0.0;
            $itemParte->pus = 0.0;
            $itemParte->total = 0.0;
            $itemParte->utilidad = 0.0;
            $itemParte->margenfinal = 0.0;

            $itemParte->save();

            $data['ItemParte'] = $itemParte;
        }



        return $this->sendResponse($data,"Se registró el item correctamente");
    }

    public function update($idItemParte, Request $request){

        $data = [];

        $itemParte = ItemParte::find($idItemParte);
        $itemParte->codiParte = $request->get("codiParte");
        $itemParte->descripcion = $request->get("descripcion");
        $itemParte->margencus = $request->get("margencus");
        $itemParte->cantidad = $request->get("cantidad");
        $itemParte->cudsin = $request->get("cudsin");
        $itemParte->cud = $request->get("cud");
        $itemParte->totald = $request->get("totald");
        $itemParte->cus = $request->get("cus");
        $itemParte->totals = $request->get("totals");
        $itemParte->pus = $request->get("pus");
        $itemParte->total = $request->get("total");
        $itemParte->utilidad = $request->get("utilidad");
        $itemParte->margenfinal = $request->get("margenfinal");

        $itemParte->update();

        $data['ItemParte'] = $itemParte;

        $this->sendResponse($data,"Se actualizó el item correctamente");
    }

    public function delete($idItemParte){

        $data = [];

        $sql = DB::select("delete from itemparte where codiCosteo = '".$idItemParte."'");

        $data['del'] = $sql;

        $this->sendResponse($data,"Se eliminó el item correctamente");

    }
}
