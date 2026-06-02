<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
   
 protected $table = 'currencies'; 
 protected $fillable = ['code', 'name', 'symbol', 'rate', 'is_base', 'is_display'];
}
