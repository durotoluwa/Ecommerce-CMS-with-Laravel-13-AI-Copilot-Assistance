<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $table = 'coupon'; 
      protected $fillable = ['code','type','value','expiry_date','usage_limit','times_used'];

    public function isValid()
    {
        return (!$this->expiry_date || $this->expiry_date >= now())
            && (!$this->usage_limit || $this->times_used < $this->usage_limit);
    }

      protected $casts = [
        'expiry_date' => 'date',
    ];

    

    public function incrementUsage()
    {
        $this->times_used++;
        $this->save();
    }
}
