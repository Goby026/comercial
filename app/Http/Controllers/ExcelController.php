<?php

namespace appComercial\Http\Controllers;

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
}
