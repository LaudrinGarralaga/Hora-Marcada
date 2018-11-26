<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva_Opcional extends Model
{
    protected $fillable = array('reserva_id','permanente_id', 'opcional_id');
    protected $table = ('reservaop');
    public $timestamps = false;

    public function Reserva()
    {
        return $this->belongsTo('App\reserva');
    }

    public function Permanente()
    {
        return $this->belongsTo('App\permanente');
    }

    public function Opcional()
    {
        return $this->belongsTo('App\opcional');
    }

}
