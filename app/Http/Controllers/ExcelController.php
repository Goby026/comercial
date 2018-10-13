<?php

namespace appComercial\Http\Controllers;

use appComercial\Utilidad;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;
use appComercial\MarcaProducto;//hacemos referencia al modelo
use DB;

class ExcelController extends Controller
{
    public function index(){
    	Excel::create('Laravel Excel', function($excel){
    		$excel->sheet('Marcas',function($sheet){
    			$marcas = MarcaProducto::all();
    			$sheet->fromArray($marcas);
    		});

    	})->export('xlsx');
    }

    public function costeoExcel(){
        //http://www.luismdeveloper.com/laravel/exportar-hoja-de-excel-desde-laravel-5/
        Excel::create('Costeo', function($excel){
            $excel->sheet('Marcas',function($sheet){
                $marcas = MarcaProducto::all();
                $sheet->fromArray($marcas);
            });
        })->export('xlsx');
    }


    public function utilidadesExcel(Request $request){
        //http://www.luismdeveloper.com/laravel/exportar-hoja-de-excel-desde-laravel-5/
        $fechaInicio = $request->get('FechaInicio');
        $fechaFin = $request->get('FechaFinal');
        $utilidades = new Utilidad();
        $data= json_decode( json_encode($utilidades->getUtilidades($fechaInicio,$fechaFin)), true);

        Excel::create('Utilidades', function($excel) use ($data){
            $excel->sheet('Utilidad',function($sheet) use ($data){
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
}
