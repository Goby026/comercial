<?php

namespace appComercial\Http\Controllers;

use appComercial\CondicionesComerciales;
use appComercial\CotiCondiciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotiCondicionesController extends Controller
{
    public function getCondiciones($codiCoti)
    {
        $condicionesComerciales = DB::select("select cc.idTCotiCondiciones, con.codiCondiComer, cc.codiCoti ,cc.descripcion , con.estado
from tcoticondiciones cc
inner join tcondicionescomerciales con on con.codiCondiComer = cc.codiCondiComer
where codiCoti = '" . $codiCoti . "' order by cc.idTCotiCondiciones ");
        return $condicionesComerciales;
    }

    public function createCondicion(Request $request){
//        $this->validate($request, [
//            'nombreSiste'=> 'required',
//            'nombreBreveSiste'=> 'required',
//            'fechaCreaSiste'=> 'required',
//            'estaSiste'=> 'required'
//        ]);

        $condicionComercial = CondicionesComerciales::findOrFail('CC_10_5_201851611281013124739');//primer registro de condiciones comerciales

        $cotiCondicion = new CotiCondiciones();
        $cotiCondicion->codiCondiComer = $condicionComercial->codiCondiComer;//cualquiera de las condiciones comerciales
        $cotiCondicion->codiCoti = $request->get('codiCoti');
        $cotiCondicion->descripcion = $request->get('descripcion');
        $cotiCondicion->estado = 1;

        $cotiCondicion->save();

        return $condicionComercial;
    }

    public function updateCondicion(Request $request, $id){

        $cotiCondicion = CotiCondiciones::find($id);
        $cotiCondicion->descripcion = $request->get('descripcion');
        $cotiCondicion->update();

        return $cotiCondicion;
    }

    public function delCondicion($id){
        $sistema = CotiCondiciones::findOrFail($id);
        $sistema->delete();
    }
}
