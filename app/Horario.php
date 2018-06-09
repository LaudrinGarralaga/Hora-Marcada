<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model {

    protected $fillable = array('hora', 'valor');
    protected $table = "horarios";
    public $timestamps = false;

}
