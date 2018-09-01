<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

class UtilidadController extends Controller
{
    public function index(){
        return view('utilidades.index');
    }
}
