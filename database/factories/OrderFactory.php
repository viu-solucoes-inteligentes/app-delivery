<?php

use Faker\Generator as Faker;



$factory->define(\ApiDelivery\Models\Order::class, function (Faker $faker) {
    $status = ['ON', 'OFF'];
    return [
        'user_id' => rand(1,55),
        'product_id' => rand(1,10),
        'status' => $status[rand(0,1)]
    ];
});
