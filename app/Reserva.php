<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = array('data', 'compareceu', 'pontos', 'valor', 'bonificacao', 'horarios_id', 'clientes_id', 'users_id');
    protected $table = "reservas";
    public $timestamps = false;

    public function horario() {

        return $this->belongsTo('App\horario');
    }

    public function cliente() {

        return $this->belongsTo('App\cliente');
    }

    public function User() {

        return $this->belongsTo('App\User');
    }

}
