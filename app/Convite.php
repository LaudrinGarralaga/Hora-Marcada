<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model {

    protected $fillable = array('convidados_id', 'reservas_id', 'clientes_id');
    protected $table = "convites";
    public $timestamps = false;

    public function convidado() {

        return $this->belongsTo('App\convidado');
    }

    public function reserva() {

        return $this->belongsTo('App\reserva');
    }

    public function clliente() {

        return $this->belongsTo('App\cliente');
    }

}
