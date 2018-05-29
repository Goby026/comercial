<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\SubFamilia;//hacemos referencia al modelo
use appComercial\Http\Requests\SubFamiliaFormRequest;
use appComercial\Custom\MyClass;
use DB;

class SubFamiliaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    	if ($request) {
    		$query = trim($request->get('searchText'));
    		$subFamilias = DB::table('tsubfamilia as sf')
    		->join('tfamilia as f','f.codiFamilia','=','sf.codiFamilia')
            ->select('sf.codiSubFamilia','sf.nombreSubFamilia','sf.nombreBreveSubFamilia','f.nombreFamilia','sf.estado')
            ->where('sf.nombreSubFamilia','LIKE','%'.$query.'%')
            ->where('sf.estado','=',1)
            ->orderBy('sf.fechaSistema','desc')
            ->paginate(5);
            return view('subFamilias.index',["subFamilias"=>$subFamilias,"searchText"=>$query]);
        }
    }

    public function create(){
    	$familias = DB::table('tfamilia')->where('estado','=','1')->get();
    	return view("subFamilias.create",["familias"=>$familias]);
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(SubFamiliaFormRequest $request){
    	$SubFamilia = new SubFamilia();
        $pk = new MyClass();

        $SubFamilia->codiSubFamilia = $pk->pk_generator("SF");
        $SubFamilia->codiFamilia = $request->get('txt_codiFamilia');
        $SubFamilia->nombreSubFamilia = $request->get('txt_nombreSubFamilia');
    	$SubFamilia->nombreBreveSubFamilia = $request->get('txt_nombreBreveSubFamilia');
    	$SubFamilia->estado = '1';
    	
    	$SubFamilia->save();

    	return Redirect::to('subFamilias');
    }

    public function show($codiSubFamilia){
    	return view('subFamilias.show', ["subFamilia"=>SubFamilia::findOrFail($codiSubFamilia)]);
    }

    public function edit($codiSubFamilia){
    	$familias = DB::table('tfamilia')->where('estado','=','1')->get();
        return view('subFamilias.edit',["subFamilia"=>SubFamilia::findOrFail($codiSubFamilia), "familias"=>$familias]);
    }

    public function update(SubFamiliaFormRequest $request, $codiSubFamilia){
    	$SubFamilia = SubFamilia::findOrFail($codiSubFamilia);

    	$SubFamilia->codiFamilia = $request->get('txt_codiFamilia');
        $SubFamilia->nombreSubFamilia = $request->get('txt_nombreSubFamilia');
    	$SubFamilia->nombreBreveSubFamilia = $request->get('txt_nombreBreveSubFamilia');
    	$SubFamilia->estado = '1';
    	
    	$SubFamilia->update();

    	return Redirect::to('subFamilias');
    }

    public function destroy($codiSubFamilia){
    	$subFamilia = SubFamilia::findOrFail($codiSubFamilia);
    	$subFamilia->estado = '0';
    	$subFamilia->update();
    	return Redirect::to('subFamilias');
    }
}
