<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcional extends Model {

    protected $fillable = array('descricao', 'valor');
    protected $table = "opcionais";
    public $timestamps = false;

}
