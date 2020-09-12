<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ledger;
use Faker\Generator as Faker;

$factory->define(Ledger::class, function (Faker $faker) {
    return [
        'number' => (string)rand(0, 1000000),
        'name' => $faker->word,
        'user_id' => rand(1, 10),
        'ledgerType_id' => rand(1, 4),
    ];
});
