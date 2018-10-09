<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = array('nome', 'telefone', 'email', 'pontos', 'senha');
    public $timestamps = false;
}
