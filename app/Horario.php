<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = array('horario');
    public $timestamps = false;

    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

}
