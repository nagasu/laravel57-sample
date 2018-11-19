<?php

use App\Eloquent\EloquentCustomer;
use Faker\Generator as Faker;

$factory->define(EloquentCustomer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
