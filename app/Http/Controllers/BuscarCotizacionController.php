<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;

class BuscarCotizacionController extends Controller
{
    public function index(){
    	return view('buscarCotizaciones.index');
    }
}
