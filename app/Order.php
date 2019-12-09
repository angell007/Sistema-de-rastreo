<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'fecha_ingreso',
        'fecha_salida',
        'user_id',
        'cliente_id',
        'consecutivo',
        'referencia',
        'serial',
        'acciones',
        'total',
        'estado',
        'diagnostico',
        'observaciones',
    ];

    protected $appends = ['valor_total'];

    public function getVAlorTotalAttribute()
    {
        return number_format($this->total);
    }

    public function accions()
    {
        return $this->belongsToMany(Accion::class)->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function historia()
    {
        return $this->belongsTo(Historia::class);
    }
}
