<?php

namespace App\Http\Controllers;

use App\Jobs\ImportTransactions;
use App\TransactionProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionProcessController extends Controller
{
    public function upload(Request $request)
    {
        $bank = $request->post('bank');
        $csvFile = $request->file('csv');
        $user = Auth::user();

//        dd([$user, $bank, $csvFile]);

        $path = $request->file('csv')->store('transactions');

        $transactionProcessor = new TransactionProcessor();
        $transactionProcessor->user_id = $user->id;
        $transactionProcessor->filename = $path;
        $transactionProcessor->bank = $bank;
        $transactionProcessor->save();

        ImportTransactions::dispatch($transactionProcessor);

        return redirect(route('dashboard'));
    }
}
