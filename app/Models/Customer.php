<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'username',
        'password',
        'address',
        'city',
        'state',
        'zipcode',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

        public function shippingAddresses()
{
    return $this->hasMany(ShippingAddress::class, 'customer_id');
}
}