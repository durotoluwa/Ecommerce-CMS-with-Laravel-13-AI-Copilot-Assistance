<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
   protected $fillable = [
        'footer_colunm1_headline','footer_colunm1',
        'footer_colunm2_headline','footer_colunm2',
        'footer_colunm3_headline','footer_colunm3',
        'footer_colunm4_headline','footer_colunm4',
    ];

    protected $casts = [
        'footer_colunm1' => 'array',
        'footer_colunm2' => 'array',
        'footer_colunm3' => 'array',
        'footer_colunm4' => 'array',
    ];
}
