<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permanente extends Model {

    protected $fillable = array('dataInicial', 'dataFinal', 'horarios_id', 'clientes_id');
    protected $table = "permanentes";
    public $timestamps = false;

    public function horario() {

        return $this->belongsTo('App\horario');
    }

    public function cliente() {

        return $this->belongsTo('App\cliente');
    }

}
