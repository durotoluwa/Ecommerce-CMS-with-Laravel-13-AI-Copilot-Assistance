<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
   use HasFactory;
   protected $table = 'blog_post'; 
    protected $fillable = [
        'title',
        'content',
        'slug',
        'blog_category_id',
        'featured_image',
        'publish_type',
        'publish_date',
        'status',
        'short_description',
        'seo_keywords',
        'seo_description',
        'seo_title',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

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


    protected $casts = [
    'publish_date' => 'datetime',
];

    
}
