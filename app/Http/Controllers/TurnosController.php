<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Turno;
use App\Oficina;
use App\Config;
use App\Tramite;

class TurnosController extends Controller
{
    public function index(){
        //$oficinas = Oficina::orderBy('denominacion')->get();
        $tramites = Tramite::where('estado', 'Habilitado')->orderBy('denominacion')->get();
        return view('turnos.index',['tramites' => $tramites]);
    }

    public function principal(){   
        return view('turnos.principal');   
    }

    public function created(Request $request){
                
        $validate = $this->validate($request, [
           'dni' => ['required', 'string','max:8'],
           'telefono' => ['required', 'string','max:11'],
           'ente' => ['required', 'string', 'max:255'],
           'tramite' => ['required', 'int', 'max:255'],
        ]);
        $dni = $request->input('dni');
        $telefono = $request->input('telefono');
        $ente = $request->input('ente');
        $tramite = $request->input('tramite');
        $date = date('Y-m-d');
            
        $turno = Turno::where('dni',$dni)->where('estado', 'Espera')->first();        
        $confs = Config::where('tramite_id', $tramite)->get();
        $count = count($confs);      

        if ($turno) {
            $info[0] = $turno;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Usted ya tiene un turno';
            $info[4] = 'danger';
        }else{
            if ($confs) {
                $turno = new Turno;
                $turno->tramite_id = $tramite;
                $turno->dni = $dni;
                $turno->telefono = $telefono;
                $turno->ente = $ente;
                $turno->estado = 'Espera';
                               
                $tur = Turno::where('oficina_id',$confs[0]->oficina_id)->where('tramite_id',$tramite)->orderBy('id','desc')->first();
                if ($tur) {
                    $horac = strtotime($confs[0]->hora_fin);
                    $min_turno = $confs[0]->min_turno;
                    $horat = strtotime($tur->hora);
                    $hora = strtotime("+$min_turno minute", $horat);       
                    $datet = $tur->fecha;
                    if ($datet > $date AND $horat < $horac AND $hora < $horac) {
                        $turno->oficina_id = $confs[0]->oficina_id;
                        $turno->fecha = $tur->fecha;
                        $hora = strtotime("+$min_turno minute", strtotime($tur->hora));
                        $hora = date('H:i', $hora);
                        $turno->hora = $hora;
                        $turno->orden = $tur->orden + 1;
                    }else{
                        $date = date('Y-m-d');
                        if ($datet > $date) {
                            $date = date('d-m-Y', strtotime($datet."+ 1 days"));    
                        }else{
                            $date = date('d-m-Y', strtotime($date."+ 1 days"));
                        }                             
                        $ban = 0;
                        $co = strlen($confs[0]->dias);
                        do {
                            $d = gregoriantojd(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
                            $val = jddayofweek($d, 0 );
                            for ($e=0; $e < $co; $e++) { 
                                if ($confs[0]->dias[$e] == $val) {
                                    $ban = 1;
                                }    
                            }
                            if ($ban == 0) {
                                $date = date('d-m-Y', strtotime($date."+ 1 days"));
                            }
                        } while ($ban == 0);

                        $turno->oficina_id = $confs[0]->oficina_id;
                        $fecha = date('Y-m-d', strtotime($date));
                        $turno->fecha = $fecha;
                        $turno->orden = 1;
                        $turno->hora = $confs[0]->hora_inicio;     
                    }
                }else{
                    $date = date('Y-m-d');
                    $date = date('d-m-Y', strtotime($date."+ 1 days"));
                    $ban = 0;
                    $co = strlen($confs[0]->dias);
                    do {
                        $d = gregoriantojd(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
                        $val = jddayofweek($d, 0 );
                        for ($e=0; $e < $co; $e++) { 
                            if ($confs[0]->dias[$e] == $val) {
                                $ban = 1;
                            }    
                        }
                        if ($ban == 0) {
                            $date = date('d-m-Y', strtotime($date."+ 1 days"));
                        }
                    } while ($ban == 0);
                    $turno->oficina_id = $confs[0]->oficina_id;
                    $fecha = date('Y-m-d', strtotime($date));
                    $turno->fecha = $fecha;
                    $turno->orden = 1;
                    $turno->hora = $confs[0]->hora_inicio;
                }
            }       
            
            $turno->save();
            $info[0] = $turno;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Solicitud de turno confirmada';
            $info[4] = 'success';                
        }

        return response()->json($info);
        
    }

    public function create(Request $request){
                
        $validate = $this->validate($request, [
           'dni' => ['required', 'string','max:8'],
           'telefono' => ['required', 'string','max:11'],
           'ente' => ['required', 'string', 'max:255'],
           'tramite' => ['required', 'int', 'max:255'],
        ]);
        $dni = $request->input('dni');
        $telefono = $request->input('telefono');
        $ente = $request->input('ente');
        $tramite = $request->input('tramite');
        $date = date('Y-m-d');
            
        //$turno = Turno::where('dni',$dni)->where('fecha','>', $date)->where('estado', 'Espera')->first();        
        $turno = Turno::where('dni',$dni)->where('estado', 'Espera')->first();        
        $confs = Config::where('tramite_id', $tramite)->get();
        $count = count($confs);      

        if ($turno) {
            $info[0] = $turno;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Usted ya tiene un turno';
            $info[4] = 'danger';
        }else{
            if ($confs) {
                $turno = new Turno;
                $turno->tramite_id = $tramite;
                $turno->dni = $dni;
                $turno->telefono = $telefono;
                $turno->ente = $ente;
                $turno->estado = 'Espera';
                $bandera = 0;
                for ($i=0; $i < $count ; $i++) { 
                    $tur = Turno::where('oficina_id',$confs[$i]->oficina_id)->where('tramite_id',$tramite)->orderBy('id','desc')->first();
                    if ($tur) {
                        $horac = strtotime($confs[$i]->hora_fin);
                        $min_turno = $confs[$i]->min_turno;
                        $horat = strtotime($tur->hora);
                        $hora = strtotime("+$min_turno minute", $horat);       
                        $datet = $tur->fecha;
                        if ($datet > $date AND $horat < $horac AND $hora < $horac) {
                            $turno->oficina_id = $confs[$i]->oficina_id;
                            $turno->fecha = $tur->fecha;
                            $hora = strtotime("+$min_turno minute", strtotime($tur->hora));
                            $hora = date('H:i', $hora);
                            $turno->hora = $hora;
                            $turno->orden = $tur->orden + 1;
                            break;
                        }else{
                            $u = $i;
                            $count1 = $count-1;
                            if ($u == $count1) {
                                $date = date('d-m-Y', strtotime($tur->fecha."+ 1 days"));
                                $co = strlen($conf[$i]->dias);
                                $ban = 0;
                                do {
                                    $d = gregoriantojd(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
                                    $val = jddayofweek($d, 0 );
                                    for ($e=0; $e < $co; $e++) { 
                                        if ($confs[0]->dias[$e] == $val) {
                                            $ban = 1;
                                        }    
                                    }
                                    if($ban == 0){
                                        $date = date('d-m-Y', strtotime($date."+ 1 days"));
                                    }
                                } while ($ban == 1);
                                $turno->oficina_id = $confs[0]->oficina_id;
                                $fecha = date('Y-m-d', strtotime($date));
                                $turno->fecha = $fecha;
                                $turno->orden = 1;
                                $turno->hora = $confs[0]->hora_inicio;     
                            }     
                        }
                    }else{
                        if ($i == 0) {
                            $date = date('Y-m-d');
                            $date = date('d-m-Y', strtotime($date."+ 1 days"));
                            $co = strlen($confs[$i]->dias);
                            $ban = 0;
                            do {
                                $d = gregoriantojd(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
                                $val = jddayofweek($d, 0 );
                                for ($e=0; $e < $co; $e++) { 
                                    if ($confs[$i]->dias[$e] == $val) {
                                        $ban = 1;
                                    }    
                                }
                                if($ban == 0){
                                    $date = date('d-m-Y', strtotime($date."+ 1 days"));
                                }
                            } while ($ban == 1);
                            $turno->oficina_id = $confs[$i]->oficina_id;
                            $fecha = date('Y-m-d', strtotime($date));
                            $turno->fecha = $fecha;
                            $turno->orden = 1;
                            $turno->hora = $confs[$i]->hora_inicio;
                            break;
                        }else{
                            $e = $i-1;
                            $tur = Turno::where('oficina_id',$confs[$e]->oficina_id)->where('tramite_id',$tramite)->orderBy('id','desc')->first();

                            $d = gregoriantojd(date('m', strtotime($tur->fecha)), date('d', strtotime($tur->fecha)), date('Y', strtotime($tur->fecha)));
                            $val = jddayofweek($d, 0 );
                            $ban = 0;
                            for ($u=0; $u < $co; $u++) { 
                                if ($confs[$i]->dias[$u] == $val) {
                                    $ban = 1;
                                }    
                            }
                            if($ban == 1){                                
                                $turno->oficina_id = $confs[$i]->oficina_id;
                                $turno->fecha = $tur->fecha;
                                $turno->orden = 1;
                                $turno->hora = $confs[$i]->hora_inicio;
                                break;
                            }                            
                        }
                        
                    }     
                }              
            }
            
            $turno->save();
            $info[0] = $turno;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Solicitud de turno confirmada';
            $info[4] = 'success';                
        }

        return response()->json($info);
    } 

    public function create_rc(Request $request){
                
        $validate = $this->validate($request, [
           'dni' => ['required', 'string','max:8'],
           'oficina' => ['required', 'int', 'max:255'],
           'tramite' => ['required', 'int', 'max:255'],
        ]);
        $dni = $request->input('dni');
        $date = date('Y-m-d');
        $turno = Turno::where('dni',$dni)->where('fecha','>', $date)->where('estado', 'Espera')->first();
        
        if ($turno) {
            $info[0] = $turno;
            $info[1] = $turno->oficina->denominacion;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Usted ya tiene un turno';
            $info[4] = 'dark';
        }else{
            $oficina = $request->input('oficina');
            $tramite = $request->input('tramite');
            $tur = Turno::where('oficina_id',$oficina)->where('tramite_id',$tramite)->orderBy('id','desc')->first();
            $conf = Config::where('oficina_id',$oficina)->where('tramite_id', $tramite)->first();
            
            $turno = new Turno;
            $turno->oficina_id = $oficina;
            $turno->tramite_id = $tramite;
            $turno->dni = $request->input('dni');
            $turno->estado = 'Espera';

            if ($tur) {
                $horat = strtotime($tur->hora);
                $horac = strtotime($conf->hora_fin);
                $hora = strtotime("+$conf->min_turno minute", strtotime($tur->hora));
                if ($horat < $horac AND $hora < $horac) {
                    $turno->fecha = $tur->fecha;
                    $hora = strtotime("+$conf->min_turno minute", strtotime($tur->hora));
                    $hora = date('H:i', $hora);
                    $turno->hora = $hora;
                    $turno->orden = $tur->orden + 1;
                }else{
                    $date = date('d-m-Y', strtotime($tur->fecha."+ 1 days"));
                    if(date('l', strtotime($date)) == 'Sunday' || date('l', strtotime($date)) == 'Saturday'){
                        $date = date('d-m-Y', strtotime($tur->fecha."+ 3 days"));
                    }
                    $fecha = date('Y-m-d', strtotime($date));
                    $turno->fecha = $fecha;
                    $turno->orden = 1;
                    $turno->hora = $conf->hora_inicio;
                }

            }else{
                $date = date('Y-m-d');
                $date = date('d-m-Y', strtotime($date."+ 1 days"));
                if(date('l', strtotime($date)) == 'Sunday' || date('l', strtotime($date)) == 'Saturday'){
                        $date = date('d-m-Y', strtotime($tur->fecha."+ 3 days"));
                }
                $fecha = date('Y-m-d', strtotime($date));
                $turno->fecha = $fecha;
                $turno->orden = 1;
                $turno->hora = $conf->hora_inicio;
            }
            $info[0] = $turno;
            $info[1] = $turno->oficina->denominacion;
            $info[2] = $turno->tramite->denominacion;
            $info[3] = 'Solicitud de turno confirmada';
            $info[4] = 'success';
            $turno->save();    
        }

        return response()->json($info);
    }    

    public function searchTurno(Request $request){

        $dni = $request->input('dni');
        $date = date('Y-m-d');

        $turno = Turno::where('dni',$dni)->where('fecha','>', $date)->where('estado', 'Espera')->first();
        
        if ($turno) {
            $message = 1;
        }else{
            $message = 0;
        }

        return response()->json($message);
    }

    public function view($fecha=''){
        $role = Auth::user()->role;
        if ($role == 'ADMIN') {
            $ofi = Oficina::all();
            foreach ($ofi as $o) {
                if ($fecha != '') {
                    $turnos["$o->denominacion"] = Turno::where('fecha',$fecha)
                                                        ->where('oficina_id', $o->id)
                                                        //->orderBy('orden')
                                                        ->orderBy('tramite_id')
                                                        ->get();
                }else{
                    $turnos["$o->denominacion"] = Turno::where('fecha',date('Y-m-d'))
                                                        ->where('oficina_id', $o->id)
                                                        //->orderBy('orden')
                                                        ->orderBy('tramite_id')
                                                        ->get();    
                }
            }
            $viene = 1;
        }else{
            $ofi = Auth::user()->oficina;
            $tramite = Auth::user()->tramite_id;
            if ($tramite != 0) {
                if ($fecha != '') {
                    $turnos["$ofi->denominacion"] = Turno::where('fecha',$fecha)
                                                            ->where('oficina_id', $ofi->id)
                                                            ->where('tramite_id', $tramite)
                                                            ->get();
                }else{
                    $turnos["$ofi->denominacion"] = Turno::where('fecha',date('Y-m-d'))
                                                            ->where('oficina_id', $ofi->id)
                                                            ->where('tramite_id', $tramite)
                                                            ->get();    
                }    
            }else{
                if ($fecha != '') {
                    $turnos["$ofi->denominacion"] = Turno::where('fecha',$fecha)
                                                            ->where('oficina_id', $ofi->id)
                                                            ->orderBy('tramite_id')
                                                            ->get();
                }else{
                    $turnos["$ofi->denominacion"] = Turno::where('fecha',date('Y-m-d'))
                                                            ->where('oficina_id', $ofi->id)
                                                            ->orderBy('tramite_id')
                                                            ->get();    
                }
            }
            
            $viene = 0;
        }
        return view('turnos.view',['fecha' => $fecha,'turnos' => $turnos, 'oficina' => $ofi , 'viene' => $viene]);
    }

    public function status(Request $request){

        $id = $request->input('turno');
        $status = $request->input('estado');
        
        $turno = Turno::find($id);
        $turno->estado = $status;
        $turno->save();
       
        return response()->json($turno);
    }

    public function buscar(){
        return view('turnos.search');
    }

    public function search(Request $request){
        $dni = $request->input('dni');
        
        $turno = Turno::where('dni',$dni)->where('fecha', date('Y-m-d'))->first();
        if ($turno) {
            $info[0] = $turno;
            $info[1] = $turno->oficina->denominacion;
            $info[2] = $turno->tramite->denominacion;
            return response()->json($info);    
        }else{
            return response()->json(0);
        }
        
    }

    public function viewScreen(){
        $turnos = Turno::where('estado','Llamado')->orWhere('estado','Atendido')->get();
        return view('turnos.screen', ['turnos' => $turnos]);
    }

    /*----------------PAGE-----------------*/

    public function seguimiento(){
        return view('seguimiento.index');   
    }
}

/*

create table users(
id int(255) auto_increment not null,
name varchar(255),
surname varchar(255),
email varchar(100),
password varchar(100),
role varchar(50),
oficina_id int(255),
tramite_id int(255),
box varchar(10),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)    
)ENGINE=InnoDB;


create table oficinas(
id int(255) auto_increment not null,
denominacion varchar(255),
direccion varchar(255),
telefono varchar(100),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_oficinas PRIMARY KEY(id)    
)ENGINE=InnoDB;

create table tramites(
id int(255) auto_increment not null,
denominacion varchar(255),
codigo varchar(100);
estado varchar(100),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_tramites PRIMARY KEY(id)    
)ENGINE=InnoDB;


create table config(
id int(255) auto_increment not null,
oficina_id int(255),
tramite_id int(255),
dias varchar(10),
hora_inicio time,
hora_fin time,
min_turno int(10),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_config PRIMARY KEY(id),
CONSTRAINT fk_config_oficina FOREIGN KEY(oficina_id) REFERENCES oficinas(id),    
CONSTRAINT fk_config_tramite FOREIGN KEY(tramite_id) REFERENCES tramites(id)
)ENGINE=InnoDB;

create table turnos(
id int(255) auto_increment not null,
oficina_id int(255),
tramite_id int(255),
dni varchar(10),
telefono varchar(100),
ente varchar(255),
fecha date,
hora time,
estado varchar(100),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_turnos PRIMARY KEY(id),
CONSTRAINT fk_turnos_oficina FOREIGN KEY(oficina_id) REFERENCES oficinas(id),    
CONSTRAINT fk_turnos_tramite FOREIGN KEY(tramite_id) REFERENCES tramites(id)
)ENGINE=InnoDB;

create table permisos(
id int(255) auto_increment not null,
user_id int(255),
oficina_id int(255),
tramite_id int(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_permisos PRIMARY KEY(id),
CONSTRAINT fk_permisos_user FOREIGN KEY(user_id) REFERENCES users(id),    
CONSTRAINT fk_permisos_oficina FOREIGN KEY(oficina_id) REFERENCES oficinas(id),    
CONSTRAINT fk_premisos_tramite FOREIGN KEY(tramite_id) REFERENCES tramites(id)
)ENGINE=InnoDB;

create table llamados(
id int(255) auto_increment not null,
user_id int(255),
turno_id int(255),
estado varchar(10),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_llamados PRIMARY KEY(id),
CONSTRAINT fk_llamados_user FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_llamados_turno FOREIGN KEY(turno_id) REFERENCES turnos(id)
)ENGINE=InnoDB;

INSERT INTO users ('name', 'surname', 'email', 'password', 'role', 'created_at', 'updated_at') VALUES ('JOSE', 'DIAZ', 'diazjose481@gmail.com', '$2y$10$gvCpKnc8gw7J5iSOHYFXDO1GhL3U/LmluNmNSe3m6lSkr9BX2UeYG', 'ADMIN', '2020-07-21', '2020-07-21');

*/