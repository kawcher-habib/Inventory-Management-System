<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
