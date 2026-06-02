<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
       protected $table = 'product_category'; 
    protected $fillable = ['name','slug','description','parent_id','thumbnail','featured'];

   public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'product_category_id',
            'product_id'
        );
    }
 
}
