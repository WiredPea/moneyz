<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'number',
        'name',
        'ledgerType_id',
    ];

    public function type()
    {
        return $this->belongsTo('\App\LegerType');
    }

    public function transactions()
    {
        return $this->hasMany('\App\RawTransaction', 'account_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
