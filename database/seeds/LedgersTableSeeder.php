<?php

use Illuminate\Database\Seeder;

class LedgersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ledger::class, 250)->create();
    }
}
