<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
 

{
     protected $table = 'shipping_address';
     protected $fillable = ['customer_id', 'fullname', 'phone', 'address'];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }



}
