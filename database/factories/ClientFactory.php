<?php

use Faker\Generator as Faker;

$factory->define(\ApiDelivery\Models\Client::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->citySuffix,
        'zipcode' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url
    ];
});
