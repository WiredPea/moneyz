<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'number',
        'name',
    ];

    public function type()
    {
        return $this->belongsTo('\App\LegerType');
    }
}
