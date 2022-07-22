<?php

namespace Database\Factories;

use App\Ledger;
use Illuminate\Database\Eloquent\Factories\Factory;

class LedgerFactory extends Factory
{
    protected $model = Ledger::class;

    public function definition()
    {
        return [
            'number' => $this->faker->iban(),
            'name' => $this->faker->word,
            'user_id' => random_int(1, 10),
            'ledgerType_id' => random_int(1, 4),
        ];
    }
}
