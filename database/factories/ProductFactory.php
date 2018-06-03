<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([$faker->lexify('Chocolate ??????'), $faker->lexify('Helado ??????'), $faker->lexify('Pepito ?????'), 'Platano '.$faker->randomElement(['Verde', 'Amarillo']), 'Queso '.$faker->randomElement(['Blanco', 'Amarillo', 'Parmesano', 'Paisa', 'Mozarela', 'Telita', 'Ricota', 'de año', 'de mano']), 'Bambino '.$faker->colorName, $faker->lexify('Refresco ?????? ').$faker->colorName, $faker->lexify('Cambur ????? ').$faker->randomElement(['Verde', 'Amarillo']), $faker->lexify('Manzana ???? ').$faker->randomElement(['Verde', 'Amarilla', 'Roja'])]),
        'price' => $faker->randomFloat(2, 100, 3000),
    ];
});