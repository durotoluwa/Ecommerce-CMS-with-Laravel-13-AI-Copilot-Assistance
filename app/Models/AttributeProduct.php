<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    protected $table = 'attribute_product';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'term_id',
        'visible',
    ];

    // Relationships
   public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

 

public function term()
{
    return $this->belongsTo(AttributeTerm::class, 'term_id');
}

}
