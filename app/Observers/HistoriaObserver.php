<?php

namespace App\Observers;

use App\Historia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoriaObserver
{
    /**
     * Handle the historia "created" event.
     *
     * @param  \App\Historia  $historia
     * @return void
     */
    public function created(Historia $historia)
    {
        //
    }

    public function creating(Historia $historia)
    {
        // $historia->user_id = Auth::user()->id;
        // $historia->fecha_registro =  Carbon::now('America/Bogota');
    }

    /**
     * Handle the historia "updated" event.
     *
     * @param  \App\Historia  $historia
     * @return void
     */
    public function updated(Historia $historia)
    {
        //
    }

    /**
     * Handle the historia "deleted" event.
     *
     * @param  \App\Historia  $historia
     * @return void
     */
    public function deleted(Historia $historia)
    {
        //
    }

    /**
     * Handle the historia "restored" event.
     *
     * @param  \App\Historia  $historia
     * @return void
     */
    public function restored(Historia $historia)
    {
        //
    }

    /**
     * Handle the historia "force deleted" event.
     *
     * @param  \App\Historia  $historia
     * @return void
     */
    public function forceDeleted(Historia $historia)
    {
        //
    }
}
