<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
	protected $table = 'permisos';

    protected $fillable = [
        'user_id', 'oficina_id', 'tramite_id',
    ];

    public function usuario(){
    	return $this->belongsTo('App\Usuario', 'user_id'); 
    }

    public function oficina(){
    	return $this->belongsTo('App\Oficina', 'oficina_id'); 
    }

    public function tramite(){
    	return $this->belongsTo('App\Tramite', 'tramite_id'); 
    }
}
