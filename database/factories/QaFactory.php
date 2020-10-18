<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Qa;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\User;

$factory->define(Qa::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => $faker->numberBetween(1, User::max('id')),
    ];
});
