<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'stock_id',
        'quantity',
        'unit_price',
        'discount',
        'vat_percent',
        'total_price',
        'paid_amount',
        'due_amount',
        'status',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}
