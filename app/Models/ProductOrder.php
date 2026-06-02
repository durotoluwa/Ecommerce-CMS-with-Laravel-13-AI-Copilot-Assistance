<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
        protected $table = 'product_order';
     protected $fillable = [
        'customer_id',
        'shipping_address_id',
        'order_no',
        'payment_reference',
        'billing_firstname',
        'billing_lastname',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_zipcode',
        'coupon_code',
        'discount',
        'billing_phone',
        'billing_email',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id');
    }
}
