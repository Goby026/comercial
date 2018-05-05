<?php

namespace appComercial\Http\Controllers;

use Illuminate\Http\Request;

use appComercial\Http\Requests;

use Illuminate\Support\Facades\Redirect;//referencia para hacer las redirecciones
use appComercial\Colaborador;//hacemos referencia al modelo
use appComercial\Http\Requests\ColaboradorFormRequest;
use appComercial\Custom\MyClass;
use DB;

class ColaboradorController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if ($request) {
            $query = trim($request->get('searchText'));
            $colaborador = DB::table('tcolaborador')->where('nombreCola','LIKE','%'.$query.'%')
            ->where('estado','=','1')
            ->orderBy('nombreCola','desc')
            ->paginate(5);
            return view('colaboradores.index',["colaborador"=>$colaborador,"searchText"=>$query]);
        }
    }

    public function create(){
        return view("colaboradores.create");
    }

    //para almacenar datos se debe validar los campos con la clase que creamos de tipo Request como parámetro de la función
    public function store(ColaboradorFormRequest $request){
        $colaborador = new Colaborador();
        $pk = new MyClass();

        $colaborador->codiCola = $pk->pk_generator("COL");
        $colaborador->apePaterCola = $request->get('txt_apePaterCola');
        $colaborador->apeMaterCola = $request->get('txt_apeMaterCola');
        $colaborador->nombreCola = $request->get('txt_nombreCola');
        $colaborador->dniCola = $request->get('txt_dniCola');
        $colaborador->fechaNaciCola = $request->get('txt_fechaNaciCola');
        $colaborador->correoCorpoCola = $request->get('txt_correoCorpoCola');
        $colaborador->correoPersoCola = $request->get('txt_correoPersoCola');
        $colaborador->celuCorpoCola = $request->get('txt_celuCorpoCola');
        $colaborador->celuPersoCola = $request->get('txt_celuPersoCola');
        $colaborador->codiDepar = $request->get('txt_codiDepar');
        $colaborador->codiProvin = $request->get('txt_codiProvin');
        $colaborador->codiDistri = $request->get('txt_codiDistri');
        $colaborador->direcCola = $request->get('txt_direcCola');
        $colaborador->fotoCola = $request->get('txt_fotoCola');
        $colaborador->fechaRegisCola = $request->get('txt_fechaRegisCola');
        $colaborador->contraCola = $request->get('txt_contraCola');
        $colaborador->estado = '1';

        $colaborador->save();

        return Redirect::to('colaboradores');
    }

    public function show($codiCola){
        return view('colaboradores.show',["colaborador"=>Colaborador::findOrFail($codiCola)]);
    }

    public function edit($codiCola){
        return view('colaboradores.edit',["colaborador"=>Colaborador::findOrFail($codiCola)]);
    }

    public function update(ColaboradorFormRequest $request, $codiCola){
        $colaborador = Colaborador::findOrFail($codiCola);

        $colaborador->apePaterCola = $request->get('txt_apePaterCola');
        $colaborador->apeMaterCola = $request->get('txt_apeMaterCola');
        $colaborador->nombreCola = $request->get('txt_nombreCola');
        $colaborador->dniCola = $request->get('txt_dniCola');
        $colaborador->fechaNaciCola = $request->get('txt_fechaNaciCola');
        $colaborador->correoCorpoCola = $request->get('txt_correoCorpoCola');
        $colaborador->correoPersoCola = $request->get('txt_correoPersoCola');
        $colaborador->celuCorpoCola = $request->get('txt_celuCorpoCola');
        $colaborador->celuPersoCola = $request->get('txt_celuPersoCola');
        $colaborador->codiDepar = $request->get('txt_codiDepar');
        $colaborador->codiProvin = $request->get('txt_codiProvin');
        $colaborador->codiDistri = $request->get('txt_codiDistri');
        $colaborador->direcCola = $request->get('txt_direcCola');
        $colaborador->fotoCola = $request->get('txt_fotoCola');
        $colaborador->fechaRegisCola = $request->get('txt_fechaRegisCola');
        $colaborador->contraCola = $request->get('txt_contraCola');
        $colaborador->estado = '1';
        
        $colaborador->update();

        return Redirect::to('colaboradores');
    }

    public function destroy($codiCola){
        $colaborador = Colaborador::findOrFail($codiCola);
        $colaborador->estado = '0';
        $colaborador->update();
        return Redirect::to('colaboradores');
    }
}
