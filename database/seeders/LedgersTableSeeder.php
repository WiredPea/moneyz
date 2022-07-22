<?php

namespace Database\Seeders;

use App\Ledger;
use Illuminate\Database\Seeder;

class LedgersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Ledger::factory()->count(250)->create();
    }
}
