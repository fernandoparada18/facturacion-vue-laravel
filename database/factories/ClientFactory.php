<?php

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dni' => $faker->ean8,
        'address' => $faker->address,
    ];
});
