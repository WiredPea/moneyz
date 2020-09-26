<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RawTransaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(RawTransaction::class, function (Faker $faker) {
    $user = User::all()->random();
    $ledger = $user->ledgers->where('ledgerType_id', '=', 1)->random();

    return [
        'account_id' => $ledger->id,
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'debitCredit' => 'D',
        'amount' => $faker->numberBetween($min = -9000, $max = 9000),
        'contraAccount' => $faker->iban('NL'),
        'contraAccountHolder' => $faker->company,
        'method' => $faker->word(),
        'description' => $faker->sentence(4),
    ];
});
