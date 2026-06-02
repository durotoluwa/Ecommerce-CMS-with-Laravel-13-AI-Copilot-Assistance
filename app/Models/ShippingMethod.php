<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_zone_id',
        'method_type',
        'rate',
    ];

   public function zone()
{
    return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
}

}
