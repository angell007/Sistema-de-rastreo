<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clausula extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
