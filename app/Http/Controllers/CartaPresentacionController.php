<?php

namespace appComercial\Http\Controllers;

use appComercial\Colaborador;
use appComercial\Contrato;
use appComercial\Cotizacion;
use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\CartaPresentacion;//hacemos referencia al modelo
use appComercial\Http\Requests\CartaPresentacionFormRequest;
use appComercial\Custom\MyClass;
use appComercial\Dolar;
use DB;
use PDF;
use View;
use App;

class CartaPresentacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));

            $cartaPresentacion = DB::table('tcartapresentacion as cp')
            ->join('ttipocartapresen as tcp','cp.codiTipoCartaPresen','=','tcp.codiTipoCartaPresen')
            ->select('cp.codiCartaPresen','tcp.tipoCartaPresen','cp.conteCartaPresen','cp.estado')//campos a mostrar de la unión
            ->where('tcp.tipoCartaPresen','LIKE','%'.$query.'%')
            ->orderBy('cp.codiCartaPresen','desc')
            ->paginate(5);

    		return view('cartaPresentacion.index',["cartaPresentacion"=>$cartaPresentacion,"searchText"=>$query]);
    	}
    }

    public function create(){
        $prodCartas = DB::table('tprodcarta')->where('estado','=','1')->get();
        $servCartas = DB::table('tservcarta')->where('estado','=','1')->get();
    	$tipoCarta = DB::table('ttipocartapresen')->where('estaTipoCartaPresen','=','1')->get();
    	return view("cartaPresentacion.create",["tipoCartas"=>$tipoCarta,"prodCartas"=>$prodCartas,"servCartas"=>$servCartas]);
    }

    //mostrar el pdf en administracion
    public function getPdf(){
        $prodCartas = DB::table('tprodcarta')->where('estado','=','1')->get();
        $servCartas = DB::table('tservcarta')->where('estado','=','1')->get();
        $view = View::make('cartaPresentacion.pdf', compact('prodCartas', 'servCartas'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('informe'.'.pdf');
    }

    //mostrar la carta de presentacion en vista previa de la cotizacion
    public function getPresentacionPdf($codiCoti)
    {
        $cotizacion = Cotizacion::findOrFail($codiCoti);
        $colaborador = Colaborador::findOrFail($cotizacion->codiCola);
        $contrato = Contrato::where('codiCola', $cotizacion->codiCola)->first();
        $prodCartas = DB::table('tprodcarta')->where('estado', '=', '1')->get();
        $servCartas = DB::table('tservcarta')->where('estado', '=', '1')->get();
        $view = View::make('cartaPresentacion.pdf', compact('prodCartas', 'servCartas', 'contrato', 'cotizacion', 'colaborador'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('cartaPresentacion' . '.pdf');
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(CartaPresentacionFormRequest $request){
        $cartaPresentacion = new CartaPresentacion();
        $pk = new MyClass();

        $cartaPresentacion->codiCartaPresen = $pk->pk_generator("CP");
        $cartaPresentacion->codiTipoCartaPresen = $request->get('txt_codiTipoCartaPresen');
        $cartaPresentacion->conteCartaPresen = $request->get('txt_conteCartaPresen');
        $cartaPresentacion->estado = '1';
        
        $cartaPresentacion->save();

        return Redirect::to('cartaPresentacion');
    }

    public function show($codiCartaPresen){
        // return view('cartaPresentacion.show',["cartaPresentacion"=>CartaPresentacion::findOrFail($codiCartaPresen)]);
        return view("cartaPresentacion.modelLetter");
    }

    public function edit($codiCartaPresen){
    	$tipoCarta = DB::table('ttipocartapresen')->where('estaTipoCartaPresen','=','1')->get();
        return view('cartaPresentacion.edit',["cartaPresentacion"=>CartaPresentacion::findOrFail($codiCartaPresen),"tipoCartas"=>$tipoCarta ]);
    }

    public function update(CartaPresentacionFormRequest $request, $codiCartaPresen){
    	$cartaPresentacion = CartaPresentacion::findOrFail($codiCartaPresen);

    	$cartaPresentacion->codiTipoCartaPresen = $request->get('txt_codiTipoCartaPresen');
    	$cartaPresentacion->conteCartaPresen = $request->get('txt_conteCartaPresen');
    	$cartaPresentacion->estado = '1';
    	
    	$cartaPresentacion->update();

    	return Redirect::to('cartaPresentacion');
    }

    public function destroy($codiCartaPresen){
    	$cartaPresentacion = CartaPresentacion::findOrFail($codiCartaPresen);
    	$cartaPresentacion->estado = '0';
    	$cartaPresentacion->update();
    	return Redirect::to('cartaPresentacion');
    }
}
