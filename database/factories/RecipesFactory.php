<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Recipes;
use Faker\Generator as Faker;

$factory->define(Recipes::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->word,
        'img' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
