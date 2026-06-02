<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreBrand extends Model
{
protected $table = 'store_brand';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'thumbnail',
    ];

    public function parent()
    {
        return $this->belongsTo(StoreBrand::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(StoreBrand::class, 'parent_id');
    }

    // Many-to-many with products via pivot
 public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'brand_product',
            'store_brand_id',   // foreign key on pivot for StoreBrand
            'product_id'        // foreign key on pivot for Product
        );
    }

}
