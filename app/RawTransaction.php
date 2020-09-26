<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawTransaction extends Model
{
    protected $fillable = [
        'account_id',
        'date',
        'debitCredit',
        'amount',
        'contraAccount',
        'contraAccountHolder',
        'method',
        'description',
        'authorizationNumber',
        'creditor',
        'reference',
    ];

    public function ledger()
    {
        return $this->hasOne('App\Ledger', 'id', 'account_id');
    }
}
