<?php

use ApiDelivery\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ApiDelivery\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'description' => $faker->text
    ];
});

$factory->state(ApiDelivery\Models\User::class, 'admin', function (Faker $faker) {
    return [
        'role' => User::ROLE_ADMIN
    ];
});

$factory->state(ApiDelivery\Models\User::class, 'client', function (Faker $faker) {
    return [
        'role' => User::ROLE_CLIENT
    ];
});
