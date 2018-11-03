<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quadra extends Model
{
    protected $fillable = array('tipo', 'preco');
    public $timestamps = false;
}
