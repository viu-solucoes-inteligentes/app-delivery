<?php

use Faker\Generator as Faker;

$factory->define(\ApiDelivery\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat('2', '1', '100'),
        'description' => $faker->text
    ];
});
