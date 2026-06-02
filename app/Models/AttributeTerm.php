<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeTerm extends Model
{
     protected $table = 'attribute_terms'; 
    protected $fillable = ['attribute_id','name','slug'];

   
    public function attributeProducts()
{
    return $this->hasMany(AttributeProduct::class);
}
public function products()
{
    return $this->belongsToMany(
        Product::class,
        'attribute_product', // pivot table
        'term_id',           // foreign key for AttributeTerm
        'product_id'         // foreign key for Product
    );
}



public function attribute()
{
    return $this->belongsTo(Attribute::class, 'attribute_id');
}

 
}
