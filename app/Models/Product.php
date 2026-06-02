<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        // Basic info
        'name',
        'description',
        'shortdescription',
        'slug',
        'user_id',

        // Pricing
        'regular_price',
        'sale_price',

          // featured image
        'featured_image',

        // Inventory
        'sku',
        'stock_status',     // in_stock, out_of_stock, on_backorder
        'stock_quantity',

        // SEO
        'seo_title',
        'seo_description',
        'seo_keywords',

        // Status & publishing
        'status',           // active, pending, draft
        'publish_type',     // immediately, schedule
        'publish_date',

        // Relationships (stored as JSON or via pivot tables)
        'gallery',          // array of image paths
    ];

    // Casts for JSON fields
    protected $casts = [
        'gallery' => 'array',
         'publish_date' => 'datetime',
    ];

    /*
     * Relationships
     */

   public function categories()
    {
        return $this->belongsToMany(
            ProductCategory::class,   // category model
            'category_product',       // pivot table
            'product_id',             // foreign key for Product
            'product_category_id'     // foreign key for ProductCategory
        );
    }


  public function storeBrands()
    {
        return $this->belongsToMany(
            StoreBrand::class,   // the actual brand model
            'brand_product',     // pivot table
            'product_id',        // foreign key on pivot for Product
            'store_brand_id'     // foreign key on pivot for StoreBrand
        );
    }

  
public function storeBrand()
{
    return $this->belongsTo(StoreBrand::class, 'store_brand_id');
}


 

    public function attributeProducts()
{
    return $this->hasMany(AttributeProduct::class);
}


    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
                    ->withPivot('term_id', 'visible')
                    ->withTimestamps();
    }

   

public function galleries()
{
    return $this->hasMany(ProductGallery::class, 'product_id');
}



public function attributeTerms()
{
    return $this->belongsToMany(
        AttributeTerm::class,      // your terms model
        'attribute_product',       // pivot table name
        'product_id',              // foreign key for Product
        'term_id'                  // foreign key for AttributeTerm
    )->withPivot('attribute_id', 'visible');
}


public function getDisplayPriceAttribute()
{
    $baseCurrency = Currency::where('is_base', true)->first();
    $displayCurrency = Currency::where('is_display', true)->first();

    $price = $this->regular_price;

    if ($baseCurrency && $displayCurrency && $baseCurrency->id !== $displayCurrency->id) {
        $price = $price * $displayCurrency->rate;
    }

    return $price;
}


public function convertPrice($price)
{
    $base = \App\Models\Currency::where('is_base', true)->first();
    $display = \App\Models\Currency::where('is_display', true)->first();

    if (!$base || !$display) {
        return $price;
    }

    // If base and display are the same, no conversion
    if ($base->id === $display->id) {
        return $price;
    }

    // Otherwise, convert
    return $price * $display->rate;
}

public function getConvertedRegularPriceAttribute()
{
    return $this->convertPrice($this->regular_price);
}

public function getConvertedSalePriceAttribute()
{
    return $this->sale_price ? $this->convertPrice($this->sale_price) : null;
}

protected $appends = [
    'converted_regular_price',
    'converted_sale_price',
];



}
