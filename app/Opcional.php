<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcional extends Model {

    Protected $fillable = array('descricao', 'valor');
    public $timestamps = false;

}
