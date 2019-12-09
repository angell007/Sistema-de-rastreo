<?php

namespace App\Providers;

use App\Empresa;
use App\Historia;
use App\Observers\HistoriaObserver;
use App\Observers\OrderObserver;
use App\Order;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        Order::observe(OrderObserver::class);
        Historia::observe(HistoriaObserver::class);

        try {
            $empresa = Empresa::first();
            if (!empty($empresa)) {
                Config::set('app.name', $empresa->nombre);
            }
        } catch (\Throwable $th) {
            // echo $th->getMessage();
        }
    }
}
