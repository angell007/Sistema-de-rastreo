<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $fillable = [
        'nombre',
        'valor',
        'descripcion'
    ];

    protected $appends = ['valor_total'];

    public function getVAlorTotalAttribute()
    {
        return number_format($this->valor);
    }


    public function getValorAttribute()
    {
        return str_replace('.', '', $this->attributes['valor']);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
