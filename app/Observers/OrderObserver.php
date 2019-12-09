<?php

namespace App\Observers;

use App\Order;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the equipo "created" event.
     *
     * @param  \App\Order  $equipo
     * @return void
     */

    public function created(Order $equipo)
    {
        $equipo->consecutivo = $equipo->id;
        //  str_pad($equipo->id, 6, '0', STR_PAD_LEFT);
        $equipo->save();
    }


    public function creating(Order $equipo)
    {
        $equipo->fecha_ingreso = Carbon::now('America/Bogota');
    }

    /**
     * Handle the equipo "updated" event.
     *
     * @param  \App\Order  $equipo
     * @return void
     */
    public function updated(Order $equipo)
    {
        //
    }

    /**
     * Handle the equipo "deleted" event.
     *
     * @param  \App\Order  $equipo
     * @return void
     */
    public function deleted(Order $equipo)
    {
        //
    }

    /**
     * Handle the equipo "restored" event.
     *
     * @param  \App\Order  $equipo
     * @return void
     */
    public function restored(Order $equipo)
    {
        //
    }

    /**
     * Handle the equipo "force deleted" event.
     *
     * @param  \App\Order  $equipo
     * @return void
     */
    public function forceDeleted(Order $equipo)
    {
        //
    }
}
