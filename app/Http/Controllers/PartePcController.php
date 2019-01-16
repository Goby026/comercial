<?php

namespace appComercial\Http\Controllers;

use appComercial\Http\Controllers\Api\ApiController;
use appComercial\PartePc;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class PartePcController extends ApiController
{
    public function index(){

        return view('partesPc.index');

    }

    public function getPartes(){
        $data = [];

        $partes = PartePc::all();

        $data['partes'] = $partes;

        return $this->sendResponse($data,"Obteniendo todas las partes de pc");
    }

    public function saveParte(Request $request)
    {
        $data = [];

        $parte = new PartePc();
        $parte->nombre = $request->get("nombre");
        $parte->descripcion = $request->get("descripcion");
        $parte->icono = $request->get("icono");
        $parte->estado = $request->get("estado");
        $parte->save();

        $data['parte'] = $parte;

        return $this->sendResponse($data, "Parte de pc registrado exitosamente");

    }

    public function updateParte($codiParte, Request $request){

        $data = [];

        $parte = PartePc::find($codiParte);

        $parte->nombre = $request->get('nombre');
        $parte->descripcion = $request->get('descripcion');
        $parte->icono = $request->get('icono');
        $parte->estado = $request->get('estado');

        $parte->update();

        $data['parte'] = $parte;

        return $this->sendResponse($data,"Se actualizó la parte indicada");
    }
}
