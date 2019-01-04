<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'price' => $faker->randomFloat(2 , 0 ,8 ), //randomFloat(casas , minimo , máximo);
        'description' => $faker->text
    ];
});
