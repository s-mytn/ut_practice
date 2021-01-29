<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Beer;
use Faker\Generator as Faker;

$factory->define(Beer::class, function (Faker $faker) {
    return [
        'name' => $faker->word(3),
    ];
});
