<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $fillable = array('nome','endereco', 'numero', 'complemento', 'cidade', 'bairro','cep', 'telefone');
    protected $table = 'local';
    public $timestamps = false;
}
