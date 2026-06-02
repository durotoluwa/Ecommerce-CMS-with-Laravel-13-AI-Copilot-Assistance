<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
     protected $table = 'attributes'; 
    protected $fillable = ['name','slug','type'];

   


    public function attributeProducts()
{
    return $this->hasMany(AttributeProduct::class);
}

public function terms()
{
    return $this->hasMany(AttributeTerm::class, 'attribute_id');
}




}
