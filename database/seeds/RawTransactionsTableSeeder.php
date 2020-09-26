<?php

use Illuminate\Database\Seeder;

class RawTransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RawTransaction::class, 2500)->create();
    }
}
