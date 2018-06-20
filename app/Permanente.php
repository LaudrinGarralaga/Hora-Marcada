<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permanente extends Model {

    protected $fillable = array('dataInicial', 'dataFinal', 'valor', 'horarios_id', 'clientes_id', 'users_id');
    protected $table = "permanentes";
    public $timestamps = false;

    public function horario() {

        return $this->belongsTo('App\horario');
    }
    
    public function opcional() {

        return $this->belongsTo('App\opcional');
    }

    public function cliente() {

        return $this->belongsTo('App\cliente');
    }

    public function User() {

        return $this->belongsTo('App\User');
    }

}
