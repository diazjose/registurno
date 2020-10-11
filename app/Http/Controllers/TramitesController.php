<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tramite;
use App\Config;

class TramitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$tramites = Tramite::orderBy('id','desc')->get();
        return view('tramites.index', ['tramites' => $tramites]);
    }

    public function create(Request $request){

    	$tramite = new Tramite;

    	$validate = $this->validate($request, [
                'denominacion' => ['required', 'string', 'max:255', 'unique:tramites'],
	        ],
            [
            	'denominacion.unique' => 'El Tramite ya existe en la Base de Datos',
            ]);


    	$tramite->denominacion = strtoupper($request->input('denominacion'));
    	$tramite->estado = 'Habilitado';
		$tramite->save();

    	return redirect()->route('tramite.index')
                         ->with(['message' => 'Tramite cargado correctamente', 'status' => 'success']);

    }

    public function update(Request $request){
    	$id = $request->input('id');
    	$tramite = Tramite::find($id);
    	
    	$tramite->denominacion = strtoupper($request->input('denominacion'));
        $tramite->estado = $request->input('estado');
    	$tramite->update();

    	return redirect()->route('tramite.index')
                         ->with(['message' => 'El tramite "'.$tramite->denominacion.'" fue actualizado con exito', 'status' => 'success']);

    }

    public function habilitar(Request $request){
        
    }

    public function destroy(Request $request){
    	$id = $request->input('id');
        $name = $request->input('tramite');
            
        $config = Config::where('tramite_id',$id)->get();

    	if (count($config) > 0) {
            return redirect()->route('tramite.index')
                         ->with(['message' => 'No se ha eliminado el tramite "'.$name .'" por que esta configurado para una oficina', 'status' => 'danger']);
        }else{
            $tramite = Tramite::find($id);
            $tramite->delete();
            return redirect()->route('tramite.index')
                         ->with(['message' => 'Se ha eliminado el tramite '.$name, 'status' => 'danger']);
    
        }
    }
}
