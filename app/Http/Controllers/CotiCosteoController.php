<?php

namespace appComercial\Http\Controllers;

use appComercial\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use appComercial\CotiCosteo;//hacemos referencia al modelo

use DB;
use Illuminate\Support\Facades\Auth;

class CotiCosteoController extends ApiController
{
    public function addCotiCosteo(Request $request){
        $data = [];

        $cotiCosteo = new CotiCosteo();

        $cotiCosteo->codiCosteo = $request->get('codiCosteo');
        $cotiCosteo->codiCoti = $request->get('codiCoti');
        $cotiCosteo->codiCola = Auth::user()->codiCola;
        $cotiCosteo->estado = 1;

        $cotiCosteo->save();

        $data['cotiCosteo'] = $cotiCosteo;

        return $this->sendResponse($data, "CotiCosteo registrado exitosamente");
    }
}
