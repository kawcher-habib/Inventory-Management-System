<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'transaction_date',
        'description',
        'type',
        'debit',
        'credit'
    ];
}
