<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moneyz:import {bank} {user} {csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a bank generated .csv file into the Moneyz system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->argument('user');
        $bank = $this->argument('bank');
        $csv = $this->argument('csv');
//        dd("$user -> $bank: $csv");

        $file = fopen($csv, 'r');
        $csvData = [];
        $data = fgetcsv($file, 0, ';');
        while($data !== false)
        {
            print_r($data);
            $data = fgetcsv($file, 0, ';');
        }
    }
}
