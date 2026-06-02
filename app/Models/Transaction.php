<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'payment_method',
        'status',
        'amount',
        'reference'
    ];

    public function order()
    {
        return $this->belongsTo(ProductOrder::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
