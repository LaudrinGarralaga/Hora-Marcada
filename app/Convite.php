<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convite extends Model
{
    protected $fillable = array('convidado_id', 'reserva_id', 'cliente_id');
    public $timestamps = false;

    public function Convidado()
    {
        return $this->belongsTo('App\Convidado');
    }

    public function Reserva()
    {
        return $this->belongsTo('App\Reserva');
    }

    public function Cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

}
