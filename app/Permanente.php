<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permanente extends Model {

    protected $fillable = array('dataInicial', 'dataFinal', 'valor', 'horarios_id', 'clientes_id', 'users_id');
    protected $table = "permanentes";
    public $timestamps = false;

    public function horario() {

        return $this->belongsTo('App\Horario');
    }
    
    public function opcional() {

        return $this->belongsTo('App\Opcional');
    }

    public function cliente() {

        return $this->belongsTo('App\Cliente');
    }

    public function User() {

        return $this->belongsTo('App\User');
    }

}
