<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {

    protected $fillable = array('data', 'compareceu', 'pontos', 'valor', 'bonificacao', 'horario_id', 'cliente_id', 'user_id', 'quadra_id');
    public $timestamps = false;

    public function Horario() {
        return $this->belongsTo('App\Horario');
    }

    public function Opcional() {
        return $this->belongsTo('App\Opcional');
    }

    public function Cliente() {
        return $this->belongsTo('App\Cliente');
    }

    public function Quadra() {
        return $this->belongsTo('App\Quadra');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }

}
