<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $table = 'testimonies';
    protected $fillable = [
        'customer_name',
        'customer_image',
        'rating',
        'title',
        'review',
        'status'
    ];
}
