<?php

namespace App\Jobs;

use App\Ledger;
use App\RawTransaction;
use App\TransactionProcessor;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportTransactions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $transactionProcessor;

    /**
     * Create a new job instance.
     *
     * @param \App\TransactionProcessor $transactionProcessor
     */
    public function __construct(TransactionProcessor $transactionProcessor)
    {
        $this->transactionProcessor = $transactionProcessor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $delimiter = null;
        $accountNumber = null;
        $date = null;
        $debitCredit = null;
        $amount = null;
        $contraAccount = null;
        $contraAccountHolder = null;
        $method = null;
        $description = null;
        $authorizationNumber = null;
        $creditor = null;
        $reference = null;

        if (strtolower($this->transactionProcessor->bank) === 'knab') {
            print("Bank type is KNAB\n");
            $delimiter = ';';
            $accountNumber = 0;
            $date = 1;
            $debitCredit = 3;
            $amount = 4;
            $contraAccount = 5;
            $contraAccountHolder = 6;
            $method = 8;
            $description = 9;
            $authorizationNumber = 11;
            $creditor = 12;
            $reference = 14;
        } else if (strtolower($this->transactionProcessor->bank) === 'sns') {
            print("Bank type is SNS\n");
            $delimiter = ',';
            $date = 0;
            $accountNumber = 1;
            $debitCredit = 3;
            $amount = 10;
            $contraAccount = 2;
            $contraAccountHolder = 3;
            $method = 14;
            $description = 17;
            $authorizationNumber = 15;
            $creditor = 12;
            $reference = 16;
        }

        $contents = Storage::get($this->transactionProcessor->filename);
        $rows = explode("\n", $contents);
        foreach (array_reverse($rows) as $row) {
            if($row == '') {
                continue;
            }
            $record = str_getcsv($row, $delimiter);
            print_r($record);
            $account = Ledger::where('number', '=', $record[$accountNumber])
                ->where('user_id', '=', $this->transactionProcessor->user_id)
                ->first();
            print($account);
            if (!$account) {
                // There was no account, but this user has data about it.
                // So, create it
                print("No account found\n");
                print("Creating account");
                $account = new Ledger([
                    'number' => $record[$accountNumber],
                    'user_id' => $this->transactionProcessor->user_id,
                    'ledgerType_id' => 1,
                ]);
                $account->save();
            }

            // normalize some bank differences
            $dc = 'D';
            $transactionAmount = 0;
            if (strtolower($this->transactionProcessor->bank) !== 'sns') {
                $dc = $record[$debitCredit];
                if ($dc === 'C') {
                    $transactionAmount = intval(strval(str_replace(',', '.',
                                $record[$amount]) * 100));
                } else {
                    $transactionAmount = intval(strval(str_replace(',', '.',
                                $record[$amount]) * 100)) * -1;
                }
            } else {
                $transactionAmount = intval(strval(str_replace(',', '.', $record[$amount]) * 100));
            }

            // Check if this transaction already exists
            $transaction = RawTransaction::firstOrCreate([
                'account_id' => $account->id,
                'date' => Carbon::parse($record[$date])->locale('nl'),
                'debitCredit' => $dc,
                'amount' => $transactionAmount,
                'contraAccount' => $record[$contraAccount],
                'contraAccountHolder' => $record[$contraAccountHolder],
                'method' => $record[$method],
                'description' => substr($record[$description], 0, 190),
                'authorizationNumber' => $record[$authorizationNumber],
                'creditor' => $record[$creditor],
                'reference' => $record[$reference],
            ]);
            $transaction->save();
        }
        print("Done\n");

        $this->transactionProcessor->delete();
    }
}
