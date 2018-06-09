<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_Opcional extends Model {

    protected $fillable = array('reservas_id', 'opcionais_id');
    protected $table = "reservas_opcionais";
    public $timestamps = false;

    public function reserva() {

        return $this->belongsTo('App\reserva');
    }

    public function opcional() {

        return $this->belongsTo('App\opcional');
    }

}
