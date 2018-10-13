<?php

namespace appComercial\Http\Controllers;

use appComercial\User;
use appComercial\Utilidad;
use Illuminate\Http\Request;

class UtilidadController extends Controller
{
    public function index()
    {

        $usuarios = User::all();

        return view('utilidades.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function getUtilidades(Request $request)
    {

        $fechaIni = $request->get('txtFechaInicio');
        $fechaFin = $request->get('txtFechaFinal');

        $utilidades = new Utilidad();

        return $utilidades->getUtilidades($fechaIni, $fechaFin);

    }

}
