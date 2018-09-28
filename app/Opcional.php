<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcional extends Model
{
    protected $fillable = array('nome', 'preco');
    public $timestamps = false;
}
