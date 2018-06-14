<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $fillable = array('nome', 'telefone', 'email');
    protected $table = "clientes";
    public $timestamps = false;

}
