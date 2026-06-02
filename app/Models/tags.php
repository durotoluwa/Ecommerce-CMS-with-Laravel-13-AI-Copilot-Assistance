<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
   protected $table = 'tags'; 
    protected $fillable = ['name', 'slug', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }
}

