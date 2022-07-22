<?php

namespace Database\Factories;

use App\RawTransaction;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RawTransactionFactory extends Factory
{
    protected $model = RawTransaction::class;

    public function definition()
    {
        $user = User::all()->random();
        $ledger = $user->ledgers->where('ledgerType_id', '=', 1)->random();

        return [
            'account_id' => $ledger->id,
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'debitCredit' => 'D',
            'amount' => $this->faker->numberBetween($min = -9000, $max = 9000),
            'contraAccount' => $this->faker->iban('NL'),
            'contraAccountHolder' => $this->faker->company,
            'method' => $this->faker->word(),
            'description' => $this->faker->sentence(10),
        ];
    }
}
