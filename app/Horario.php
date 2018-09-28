<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = array('horario', 'preco');
    public $timestamps = false;

    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

}
