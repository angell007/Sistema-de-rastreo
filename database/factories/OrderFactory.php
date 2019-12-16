<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Order::class, function (Faker $faker) {

    static $number = 1;
    return [

        'fecha_ingreso' => now(),
        'user_id'=> $faker->randomElement([1, 2]),
        'cliente_id' =>$faker->randomElement([1, 2]),
        'consecutivo'=> $number++,
        'referencia' => $faker->unique()->randomNumber,
        'serial'=> $faker->unique()->randomNumber,
        'accion_id' => $faker->randomElement([1, 2, 3]),
        'estado' => $faker->randomElement(['Entregado', 'En proceso']),
        'diagnostico' => $faker->sentences(5, true),
        'observaciones' => $faker->sentences(5, true),
        'total' => $faker->randomNumber,
    ];
});
