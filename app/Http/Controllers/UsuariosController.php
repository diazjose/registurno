<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Oficina;
use App\Tramite;
use App\Permiso;


class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(){
    	$users = User::orderBy('oficina_id','ASC')->orderBy('tramite_id', 'ASC')->get();
    	return view('usuarios.index', ['users' => $users]);
    }

    public function new(){
        $oficinas = Oficina::orderBy('denominacion')->get();
    	return view('usuarios.new', ['oficinas' => $oficinas]);
    }

    public function create(Request $request){

    	$user = new User;

    	$validate = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
	            'surname' => ['required', 'string', 'max:255'],
	            'role' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
            	'email.unique' => 'Este correo ya existe en la Base de Datos',
            	'password.confirmed' => 'Las contraseñas no coinciden',
            ]);


    	$user->name = strtoupper($request->input('name'));
    	$user->surname = strtoupper($request->input('surname'));
		$user->email = $request->input('email');
		$user->role = $request->input('role');
        $user->oficina_id = $request->input('oficina');
        $user->tramite_id = $request->input('tramite');
    	$user->password = Hash::make($request->input('password'));
    	
		$user->save();

    	return redirect()->route('user.index');
                         //->with(['message' => 'Usuario cargado correctamente', 'status' => 'success']);

    }

    public function view($id){

    	$user = User::find($id);
    	$oficina = Oficina::all();
        $tramites = Tramite::orderBy('denominacion')->get();
    	return view('usuarios.view', ['user' => $user,'oficinas' => $oficina,'tramites' => $tramites]);
    
    }

    public function permiso(Request $request){

        $permiso = new Permiso;
        $permiso->user_id = $request->input('user_id');
        $permiso->oficina_id = $request->input('oficina_id');
        $permiso->tramite_id = $request->input('tramite_id');
        $permiso->save();
        return redirect()->route('user.view', [$permiso->user_id])
                         ->with(['message' => 'Permiso cargado correctamente', 'status' => 'success']);
    }
}

