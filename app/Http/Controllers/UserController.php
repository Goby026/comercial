<?php

namespace appComercial\Http\Controllers;

use appComercial\Area;
use appComercial\Cargo;
use appComercial\User;
use Illuminate\Http\Request;

use appComercial\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $users = DB::table('users as u')
                ->join('tcolaborador as col', 'col.codiCola', '=', 'u.codiCola')
                ->join('tcontrato as con', 'con.codiCola', '=', 'col.codiCola')
                ->join('tcargo as car', 'car.codiCargo', '=', 'con.codiCargo')
                ->join('tarea as a', 'a.codiArea', '=', 'car.codiArea')
                ->select('u.id','u.name','u.username','u.email','a.nombreArea', 'car.nombreCargo')
                ->where('u.name','LIKE','%'.$query.'%')
                ->where('u.estado','=',1)
                ->paginate(5);

            return view('usersComercial.index', ["users" => $users, "searchText" => $query]);
        }
    }

    public function create()
    {
        $cargos = Cargo::all();
        $areas = Area::all();
        return view("usersComercial.create", [
            "cargos" => $cargos,
            "areas" => $areas
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->get('txt_name');
        $user->username = $request->get('txt_username');
        $user->email = $request->get('txt_email');
        $user->password = bcrypt($request->get('txt_password'));
        $user->codiCola = $request->get('txt_codiCola');
        $user->codiCargo = $request->get('txt_codiCargo');
        $user->codiArea = $request->get('txt_codiArea');
        $user->estado = 1;

        $user->save();

        return Redirect::to('usersComercial');
    }

    public function show($id)
    {
        return view('usersComercial.show', ["user" => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        $areas = Area::all();
        $cargos = Cargo::all();

        return view('usersComercial.edit', ["user" => User::findOrFail($id), "areas" => $areas, "cargos" => $cargos]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->get('txt_name');
        $user->username = $request->get('txt_username');
        $user->email = $request->get('txt_email');
        $user->password = bcrypt($request->get('txt_password'));
        $user->codiCola = $request->get('txt_codiCola');
        $user->codiCargo = $request->get('txt_codiCargo');
        $user->codiArea = $request->get('txt_codiArea');

        $user->update();

        return Redirect::to('usersComercial');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->estado = 0;
        $user->update();
        return Redirect::to('usersComercial.index');
    }
}
