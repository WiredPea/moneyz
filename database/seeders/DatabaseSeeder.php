<?php

use Database\Seeders\UsersTableSeeder;
use Database\Seeders\LedgersTableSeeder;
use Database\Seeders\RawTransactionsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(LedgersTableSeeder::class);
         $this->call(RawTransactionsTableSeeder::class);
    }
}
