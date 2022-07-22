<?php

namespace Database\Seeders;

use App\RawTransaction;
use Illuminate\Database\Seeder;

class RawTransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        RawTransaction::factory()->count(2500)->create();
    }
}
