<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{

  use HasFactory;
   protected $table = 'pages'; 
     protected $fillable = [
        'title',
        'content',
        'slug',
        'featured_image',
        'publish_type',
        'publish_date',
        'status',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'publish_date' => 'datetime',
    ];

protected static function boot()
{
    parent::boot();

    static::creating(function ($page) {
        $page->slug = static::generateUniqueSlug($page->title);
    });

    static::updating(function ($page) {
        if ($page->isDirty('title')) {
            $page->slug = static::generateUniqueSlug($page->title, $page->id);
        }
    });
}

protected static function generateUniqueSlug($title, $ignoreId = null)
{
    $slug = \Illuminate\Support\Str::slug($title);
    $originalSlug = $slug;
    $counter = 1;

    while (static::where('slug', $slug)
        ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
        ->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }

    return $slug;
}

}
