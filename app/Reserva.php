<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = array('data', 'valor', 'horarios_id', 'clientes_id', 'users_id');
    protected $table = "reservas";
    public $timestamps = false;

    public function horario() {

        return $this->belongsTo('App\Horario');
    }

    public function opcional() {

        return $this->belongsTo('App\opcional');
    }

    public function cliente() {

        return $this->belongsTo('App\Cliente');
    }

    public function User() {

        return $this->belongsTo('App\User');
    }

}
