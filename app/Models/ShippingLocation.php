<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_zone_id',
        'country',
        'state',
        'city',
        'postal_code',
    ];

 
public function zone()
{
    return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
}

}
