<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

class MercaderiaController extends Controller
{
    public function saveMercaderia(Request $request){

        return $request->get('cantMerca');
    }
}
