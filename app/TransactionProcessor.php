<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionProcessor extends Model
{
    protected $fillable = [
        'user_id',
        'filename',
        'bank',
    ];
}
