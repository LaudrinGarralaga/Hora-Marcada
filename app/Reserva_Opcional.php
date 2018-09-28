<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_Opcional extends Model
{
    protected $fillable = array('reserva_id', 'opcionai_id');
    public $timestamps = false;

    public function Reserva()
    {
        return $this->belongsTo('App\reserva');
    }

    public function Opcional()
    {
        return $this->belongsTo('App\opcional');
    }

}
