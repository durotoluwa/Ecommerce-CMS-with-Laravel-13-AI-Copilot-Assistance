<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSlider extends Model
{

 protected $table = 'banner_slider'; 
   protected $fillable = [
        'heading1',
        'heading2',
        'button_title',
        'button_link',
        'slider_image',
        'status',
    ];
}
