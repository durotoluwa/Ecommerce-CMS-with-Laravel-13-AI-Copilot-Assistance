<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menuitemdrag extends Model
{

    protected $table = 'menuitemdrag'; 
   protected $fillable = [
        'label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id'
    ];

    public function parentItem()
    {
        return $this->belongsTo(menuitemdrag::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(menuitemdrag::class, 'parent')->orderBy('sort');
    }

  

    // Children relationship (renamed to avoid conflict)
    public function submenus()
    {
        return $this->hasMany(Menuitemdrag::class, 'parent')->with('submenus');
    }

    

    // Children relationship (renamed to avoid conflict)
 

}
