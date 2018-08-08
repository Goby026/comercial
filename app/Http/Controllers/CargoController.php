<?php

namespace appComercial\Http\Controllers;

use appComercial\Cargo;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

class CargoController extends Controller
{
    public function getCargos(){
        $cargos = Cargo::findOrFail(Auth()->user()->codiCargo);

        dd($cargos);
    }
}
