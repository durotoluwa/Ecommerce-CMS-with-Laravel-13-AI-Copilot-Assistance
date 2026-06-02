<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
protected $fillable = [

    'title',
    'url',
    'parent_id',
    'sort_order',
    'is_mega',
    'mega_columns',

    'type',
    'reference_id',
    'model_type',
    'target',
];

    /*
    |--------------------------------------------------------------------------
    | Children
    |--------------------------------------------------------------------------
    */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->with('children')
            ->orderBy('sort_order');
    }

    /*
    |--------------------------------------------------------------------------
    | Parent
    |--------------------------------------------------------------------------
    */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
