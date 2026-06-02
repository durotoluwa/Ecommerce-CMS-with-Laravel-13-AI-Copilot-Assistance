<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaystackSettings extends Model
{
     protected $table = 'paystack_setting'; 
      protected $fillable = ['public_key', 'secret_key', 'merchant_email', 'status'];
  
}
