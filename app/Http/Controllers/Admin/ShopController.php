<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\AttributeTerm;
use App\Models\Attribute;
use App\Models\StoreBrand;
use App\Models\Currency;




class ShopController extends Controller
{
      

  public function index(Request $request)
{
    $products = Product::paginate(20); // initial batch

    /*
    |--------------------------------------------------------------------------
    | ADD THIS
    |--------------------------------------------------------------------------
    */

    $minPrice = Product::min('regular_price');

    $maxPrice = Product::max('regular_price');

    $baseCurrency = Currency::where('is_base', true)->first();

    $displayCurrency = Currency::where('is_display', true)->first();

    if ($baseCurrency && $displayCurrency) {

        $minPrice = $minPrice * $displayCurrency->rate;

        $maxPrice = $maxPrice * $displayCurrency->rate;
    }

    /*
    |--------------------------------------------------------------------------
    | END
    |--------------------------------------------------------------------------
    */

    $categories = ProductCategory::withCount('products')
        ->having('products_count', '>', 0)
        ->get();

    $brands = StoreBrand::withCount('products')
        ->having('products_count', '>', 0)
        ->get();

    // Find the "Color" attribute
    $colorAttribute = Attribute::where('name', 'Color')->first();

    $colors = AttributeTerm::where('attribute_id', $colorAttribute->id)
        ->withCount('products')
        ->having('products_count', '>', 0)
        ->get();

    // Find the "Size" attribute
    $sizeAttribute = Attribute::where('name', 'Size')->first();

    $sizes = AttributeTerm::where('attribute_id', $sizeAttribute->id)
        ->withCount('products')
        ->having('products_count', '>', 0)
        ->get();

    if ($request->ajax()) {

        return response()->json([

            'success' => true,

            'html' => view(
                'shop.partials.products',
                compact('products')
            )->render(),

            'nextPage' => $products->nextPageUrl()
        ]);
    }

    return view('shop.index', compact(
        'products',
        'categories',
        'sizes',
        'colors',
        'brands',
        'minPrice',
        'maxPrice'
    ));
}

 

 




public function show($slug, Request $request)
{
    // Try brand first
    $brand = \App\Models\StoreBrand::where('slug', $slug)->first();

    if ($brand) {

        $products = \App\Models\Product::whereHas('storeBrands', function ($q) use ($brand) {

                $q->where('store_brand_id', $brand->id);

            })

            ->paginate(12);

        /*
        |--------------------------------------------------------------------------
        | ADD THIS
        |--------------------------------------------------------------------------
        */

        $minPrice = (clone $products->getCollection())
            ->min('converted_regular_price');

        $maxPrice = (clone $products->getCollection())
            ->max('converted_regular_price');

        /*
        |--------------------------------------------------------------------------
        | END
        |--------------------------------------------------------------------------
        */

        // Categories linked to this brand’s products
        $categories = \App\Models\ProductCategory::whereHas('products.storeBrands', function ($q) use ($brand) {

                $q->where('store_brand_id', $brand->id);

            })

            ->withCount(['products as products_count' => function ($q) use ($brand) {

                $q->whereHas('storeBrands', function ($q2) use ($brand) {

                    $q2->where('store_brand_id', $brand->id);

                });

            }])

            ->get();

        // Colors available for this brand
        $colorAttribute = \App\Models\Attribute::where('name', 'Color')->first();

        $colors = collect();

        if ($colorAttribute) {

            $colors = \App\Models\AttributeTerm::where('attribute_id', $colorAttribute->id)

                ->whereHas('products.storeBrands', function ($q) use ($brand) {

                    $q->where('store_brand_id', $brand->id);

                })

                ->withCount(['products as products_count' => function ($q) use ($brand) {

                    $q->whereHas('storeBrands', function ($q2) use ($brand) {

                        $q2->where('store_brand_id', $brand->id);

                    });

                }])

                ->get();
        }

        // Sizes available for this brand
        $sizeAttribute = \App\Models\Attribute::where('name', 'Size')->first();

        $sizes = collect();

        if ($sizeAttribute) {

            $sizes = \App\Models\AttributeTerm::where('attribute_id', $sizeAttribute->id)

                ->whereHas('products.storeBrands', function ($q) use ($brand) {

                    $q->where('store_brand_id', $brand->id);

                })

                ->withCount(['products as products_count' => function ($q) use ($brand) {

                    $q->whereHas('storeBrands', function ($q2) use ($brand) {

                        $q2->where('store_brand_id', $brand->id);

                    });

                }])

                ->get();
        }

        // Brands list not needed here
        $brands = collect();

        return view('shop.index', compact(
            'brand',
            'products',
            'categories',
            'brands',
            'colors',
            'sizes',
            'minPrice',
            'maxPrice'
        ));
    }

    // Otherwise treat as category
    $category = \App\Models\ProductCategory::where('slug', $slug)->firstOrFail();

    $products = $category->products()->paginate(12);

    /*
    |--------------------------------------------------------------------------
    | ADD THIS
    |--------------------------------------------------------------------------
    */

    $minPrice = (clone $products->getCollection())
        ->min('converted_regular_price');

    $maxPrice = (clone $products->getCollection())
        ->max('converted_regular_price');

    /*
    |--------------------------------------------------------------------------
    | END
    |--------------------------------------------------------------------------
    */

    $categories = $category->children()

        ->withCount('products')

        ->having('products_count', '>', 0)

        ->get();

    $brands = \App\Models\StoreBrand::whereHas('products.categories', function ($q) use ($category) {

            $q->where('product_category_id', $category->id);

        })

        ->withCount(['products as products_count' => function ($q) use ($category) {

            $q->whereHas('categories', function ($q2) use ($category) {

                $q2->where('product_category_id', $category->id);

            });

        }])

        ->get();

    $colorAttribute = \App\Models\Attribute::where('name', 'Color')->first();

    $colors = collect();

    if ($colorAttribute) {

        $colors = \App\Models\AttributeTerm::where('attribute_id', $colorAttribute->id)

            ->whereHas('products.categories', function ($q) use ($category) {

                $q->where('product_category_id', $category->id);

            })

            ->withCount(['products as products_count' => function ($q) use ($category) {

                $q->whereHas('categories', function ($q2) use ($category) {

                    $q2->where('product_category_id', $category->id);

                });

            }])

            ->get();
    }

    $sizeAttribute = \App\Models\Attribute::where('name', 'Size')->first();

    $sizes = collect();

    if ($sizeAttribute) {

        $sizes = \App\Models\AttributeTerm::where('attribute_id', $sizeAttribute->id)

            ->whereHas('products.categories', function ($q) use ($category) {

                $q->where('product_category_id', $category->id);

            })

            ->withCount(['products as products_count' => function ($q) use ($category) {

                $q->whereHas('categories', function ($q2) use ($category) {

                    $q2->where('product_category_id', $category->id);

                });

            }])

            ->get();
    }

    return view('shop.index', compact(
        'category',
        'products',
        'categories',
        'brands',
        'colors',
        'sizes',
        'minPrice',
        'maxPrice'
    ));
}


   // shop sidebar function

public function filterByCategories(Request $request)
{
    $query = Product::query();

    // Category filter
    if (!empty($request->categories)) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->whereIn('product_category_id', $request->categories);
        });
    }

    // Size filter
    if (!empty($request->sizes)) {
        $query->whereHas('attributeTerms', function ($q) use ($request) {
            $q->whereIn('term_id', $request->sizes);
        });
    }

    if (!empty($request->colors)) {
    $query->whereHas('attributeTerms', function ($q) use ($request) {
        $q->whereIn('term_id', $request->colors);
    });
}

if (!empty($request->brands)) {
    $query->whereHas('storeBrands', function ($q) use ($request) {
        $q->whereIn('store_brand_id', $request->brands);
    });
}

// Price filter
if ($request->filled('min_price') || $request->filled('max_price')) {

    $baseCurrency = Currency::where('is_base', true)->first();

    $displayCurrency = Currency::where('is_display', true)->first();

    $minPrice = $request->min_price ?? 0;

    $maxPrice = $request->max_price ?? PHP_INT_MAX;

    /*
    |--------------------------------------------------------------------------
    | Convert display currency back to base currency
    |--------------------------------------------------------------------------
    */

    if ($baseCurrency && $displayCurrency) {

        $minPrice = $minPrice / $displayCurrency->rate;

        $maxPrice = $maxPrice / $displayCurrency->rate;
    }

    $query->whereBetween('regular_price', [

        $minPrice,

        $maxPrice
    ]);
}


    $products = $query->distinct()->paginate(20, ['*'], 'page', $request->page ?? 1);

    return response()->json([
        'success' => true,
        'html' => view('shop.partials.products', compact('products'))->render(),
        'nextPage' => $products->hasMorePages() ? $products->nextPageUrl() : null,
        'firstItem' => $products->firstItem(),
        'lastItem' => $products->lastItem(),
        'total' => $products->total(),
    ]);
}





public function filterByCategoryPage(Request $request, $id)
{
    /*
    |--------------------------------------------------------------------------
    | Base Query: Products in this category
    |--------------------------------------------------------------------------
    */

    $query = Product::query();

    $query->whereHas('categories', function ($q) use ($id) {

        $q->where('product_category_id', $id);

    });

    /*
    |--------------------------------------------------------------------------
    | Apply Filters
    |--------------------------------------------------------------------------
    */

    // Categories
    if (!empty($request->categories)) {

        $query->whereHas('categories', function ($q) use ($request) {

            $q->whereIn(
                'product_category_id',
                $request->categories
            );

        });
    }

    // Sizes
    if (!empty($request->sizes)) {

        $query->whereHas('attributeTerms', function ($q) use ($request) {

            $q->whereIn('term_id', $request->sizes)

              ->whereHas('attribute', function ($attr) {

                    $attr->where('slug', 'size');

              });

        });
    }

    // Colors
    if (!empty($request->colors)) {

        $query->whereHas('attributeTerms', function ($q) use ($request) {

            $q->whereIn('term_id', $request->colors)

              ->whereHas('attribute', function ($attr) {

                    $attr->where('slug', 'color');

              });

        });
    }

    // Brands
    if (!empty($request->brands)) {

        $query->whereHas('storeBrands', function ($q) use ($request) {

            $q->whereIn(
                'store_brand_id',
                $request->brands
            );

        });
    }

    /*
    |--------------------------------------------------------------------------
    | PRICE FILTER WITH CURRENCY CONVERTER
    |--------------------------------------------------------------------------
    */

    if ($request->filled('min_price') || $request->filled('max_price')) {

        $baseCurrency = Currency::where(
            'is_base',
            true
        )->first();

        $displayCurrency = Currency::where(
            'is_display',
            true
        )->first();

        $minPrice = $request->min_price ?? 0;

        $maxPrice = $request->max_price ?? PHP_INT_MAX;

        /*
        |--------------------------------------------------------------------------
        | Convert Display Currency Back To Base Currency
        |--------------------------------------------------------------------------
        */

        if ($baseCurrency && $displayCurrency) {

            $minPrice = $minPrice / $displayCurrency->rate;

            $maxPrice = $maxPrice / $displayCurrency->rate;
        }

        $query->whereBetween('regular_price', [

            $minPrice,

            $maxPrice
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    $products = $query

        ->with([
            'categories',
            'storeBrands',
            'attributeTerms.attribute'
        ])

        ->distinct('products.id')

        ->paginate(20);

    $productCollection = $products->getCollection();

    /*
    |--------------------------------------------------------------------------
    | Dynamic Filters (Scoped To Current Results)
    |--------------------------------------------------------------------------
    */

    // Sub Categories
    $categories = ProductCategory::where('parent_id', $id)

        ->whereHas('products', function ($q) use ($products) {

            $q->whereIn(
                'products.id',
                $products->pluck('id')
            );

        })

        ->withCount('products')

        ->having('products_count', '>', 0)

        ->get();

    // Brands
    $brandIds = $productCollection

        ->pluck('storeBrands')

        ->flatten()

        ->pluck('id')

        ->unique();

    $brands = StoreBrand::whereIn('id', $brandIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('categories', function ($c) use ($id) {

                    $c->where(
                        'product_category_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    // Sizes
    $sizeIds = $productCollection

        ->pluck('attributeTerms')

        ->flatten()

        ->filter(function ($term) {

            return optional($term->attribute)->slug === 'size';

        })

        ->pluck('id')

        ->unique();

    $sizes = AttributeTerm::whereIn('id', $sizeIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('categories', function ($c) use ($id) {

                    $c->where(
                        'product_category_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    // Colors
    $colorIds = $productCollection

        ->pluck('attributeTerms')

        ->flatten()

        ->filter(function ($term) {

            return optional($term->attribute)->slug === 'color';

        })

        ->pluck('id')

        ->unique();

    $colors = AttributeTerm::whereIn('id', $colorIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('categories', function ($c) use ($id) {

                    $c->where(
                        'product_category_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Min & Max Price
    |--------------------------------------------------------------------------
    */

    $allProducts = (clone $query)->get();

    $minPrice = $allProducts->min(
        'converted_regular_price'
    );

    $maxPrice = $allProducts->max(
        'converted_regular_price'
    );

    /*
    |--------------------------------------------------------------------------
    | Return Response
    |--------------------------------------------------------------------------
    */

    return response()->json([

        'success' => true,

        'html' => view(
            'product-category.partials.products',
            compact('products')
        )->render(),

        'sidebar' => view(
            'product-category.product_sidebar',
            compact(
                'categories',
                'brands',
                'sizes',
                'colors',
                'minPrice',
                'maxPrice'
            )
        )->render(),

        'nextPage' => $products->hasMorePages()
            ? $products->nextPageUrl()
            : null,

        'firstItem' => $products->firstItem(),

        'lastItem' => $products->lastItem(),

        'total' => $products->total(),
    ]);
}



public function showCategory($slug, Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Current Category
    |--------------------------------------------------------------------------
    */

    $category = ProductCategory::where('slug', $slug)
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | MASTER PRODUCT QUERY
    |--------------------------------------------------------------------------
    */

    $productsQuery = Product::query()

        ->whereHas('categories', function ($q) use ($category) {

            $q->where(
                'product_category_id',
                $category->id
            );

        })

        ->with([
            'categories',
            'storeBrands',
            'attributeTerms.attribute'
        ]);

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    $products = $productsQuery
        ->distinct()
        ->paginate(12);


        /*
|--------------------------------------------------------------------------
| MIN & MAX PRICE
|--------------------------------------------------------------------------
*/

$allProducts = (clone $productsQuery)->get();

$minPrice = $allProducts->min('converted_regular_price');

$maxPrice = $allProducts->max('converted_regular_price');

    /*
    |--------------------------------------------------------------------------
    | Product IDs FROM SAME QUERY
    |--------------------------------------------------------------------------
    */

    $productIds = (clone $productsQuery)
        ->pluck('products.id');

    /*
    |--------------------------------------------------------------------------
    | Categories FILTER
    |--------------------------------------------------------------------------
    */

    $categories = ProductCategory::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn('products.id', $productIds);

        })

        ->where('parent_id', $category->id)

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn('products.id', $productIds);

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Brands FILTER
    |--------------------------------------------------------------------------
    */

    $brands = StoreBrand::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn('products.id', $productIds);

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn('products.id', $productIds);

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Sizes FILTER
    |--------------------------------------------------------------------------
    */

    $sizes = AttributeTerm::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn('products.id', $productIds);

        })

        ->whereHas('attribute', function ($q) {

            $q->where('slug', 'size');

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn('products.id', $productIds);

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Colors FILTER
    |--------------------------------------------------------------------------
    */

    $colors = AttributeTerm::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn('products.id', $productIds);

        })

        ->whereHas('attribute', function ($q) {

            $q->where('slug', 'color');

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn('products.id', $productIds);

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */

    return view('product-category.index', [

        'category'   => $category,
        'products'   => $products,
        'categories' => $categories,
        'brands'     => $brands,
        'sizes'      => $sizes,
        'colors'     => $colors,
        'id'         => $category->id,
         'minPrice'   => $minPrice,
    'maxPrice'   => $maxPrice,
    ]);
}











public function showBrand($slug, Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | Current Brand
    |--------------------------------------------------------------------------
    */

    $brand = StoreBrand::where('slug', $slug)
        ->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | MASTER PRODUCT QUERY
    |--------------------------------------------------------------------------
    */

    $productsQuery = Product::query()

        ->whereHas('storeBrands', function ($q) use ($brand) {

            $q->where(
                'store_brand_id',
                $brand->id
            );

        })

        ->with([
            'categories',
            'storeBrands',
            'attributeTerms.attribute'
        ]);

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    $products = $productsQuery
        ->distinct()
        ->paginate(12);


        /*
|--------------------------------------------------------------------------
| MIN & MAX PRICE
|--------------------------------------------------------------------------
*/

$allProducts = (clone $productsQuery)->get();

$minPrice = $allProducts->min('converted_regular_price');

$maxPrice = $allProducts->max('converted_regular_price');

    /*
    |--------------------------------------------------------------------------
    | Product IDs FROM SAME QUERY
    |--------------------------------------------------------------------------
    */

    $productIds = (clone $productsQuery)
        ->pluck('products.id');

    /*
    |--------------------------------------------------------------------------
    | Categories FILTER
    |--------------------------------------------------------------------------
    */

    $categories = ProductCategory::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn(
                'products.id',
                $productIds
            );

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn(
                    'products.id',
                    $productIds
                );

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Brands FILTER
    |--------------------------------------------------------------------------
    */

    $brands = StoreBrand::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn(
                'products.id',
                $productIds
            );

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn(
                    'products.id',
                    $productIds
                );

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Sizes FILTER
    |--------------------------------------------------------------------------
    */

    $sizes = AttributeTerm::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn(
                'products.id',
                $productIds
            );

        })

        ->whereHas('attribute', function ($q) {

            $q->where('slug', 'size');

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn(
                    'products.id',
                    $productIds
                );

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Colors FILTER
    |--------------------------------------------------------------------------
    */

    $colors = AttributeTerm::query()

        ->whereHas('products', function ($q) use ($productIds) {

            $q->whereIn(
                'products.id',
                $productIds
            );

        })

        ->whereHas('attribute', function ($q) {

            $q->where('slug', 'color');

        })

        ->withCount([
            'products' => function ($q) use ($productIds) {

                $q->whereIn(
                    'products.id',
                    $productIds
                );

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */

    return view('brand.index', [

        'brand'      => $brand,
        'products'   => $products,
        'categories' => $categories,
        'brands'     => $brands,
        'sizes'      => $sizes,
        'colors'     => $colors,
        'id'         => $brand->id,
         'minPrice'   => $minPrice,
    'maxPrice'   => $maxPrice,
    ]);
}






public function filterBybrandPage(Request $request, $id)
{
    /*
    |--------------------------------------------------------------------------
    | Base Query: Products in this BRAND
    |--------------------------------------------------------------------------
    */

    $query = Product::query();

    $query->whereHas('storeBrands', function ($q) use ($id) {

        $q->where('store_brand_id', $id);

    });

    /*
    |--------------------------------------------------------------------------
    | Apply Filters
    |--------------------------------------------------------------------------
    */

    // Categories
    if (!empty($request->categories)) {

        $query->whereHas('categories', function ($q) use ($request) {

            $q->whereIn(
                'product_category_id',
                $request->categories
            );

        });
    }

    // Sizes
    if (!empty($request->sizes)) {

        $query->whereHas('attributeTerms', function ($q) use ($request) {

            $q->whereIn('term_id', $request->sizes)

              ->whereHas('attribute', function ($attr) {

                    $attr->where('slug', 'size');

              });

        });
    }

    // Colors
    if (!empty($request->colors)) {

        $query->whereHas('attributeTerms', function ($q) use ($request) {

            $q->whereIn('term_id', $request->colors)

              ->whereHas('attribute', function ($attr) {

                    $attr->where('slug', 'color');

              });

        });
    }

    // Brands
    if (!empty($request->brands)) {

        $query->whereHas('storeBrands', function ($q) use ($request) {

            $q->whereIn(
                'store_brand_id',
                $request->brands
            );

        });
    }

    /*
    |--------------------------------------------------------------------------
    | PRICE FILTER WITH CURRENCY CONVERTER
    |--------------------------------------------------------------------------
    */

    if ($request->filled('min_price') || $request->filled('max_price')) {

        $baseCurrency = Currency::where(
            'is_base',
            true
        )->first();

        $displayCurrency = Currency::where(
            'is_display',
            true
        )->first();

        $minPrice = $request->min_price ?? 0;

        $maxPrice = $request->max_price ?? PHP_INT_MAX;

        /*
        |--------------------------------------------------------------------------
        | Convert Display Currency Back To Base Currency
        |--------------------------------------------------------------------------
        */

        if ($baseCurrency && $displayCurrency) {

            $minPrice = $minPrice / $displayCurrency->rate;

            $maxPrice = $maxPrice / $displayCurrency->rate;
        }

        $query->whereBetween('regular_price', [

            $minPrice,

            $maxPrice
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */

    $products = $query

        ->with([
            'categories',
            'storeBrands',
            'attributeTerms.attribute'
        ])

        ->distinct('products.id')

        ->paginate(20);

    $productCollection = $products->getCollection();

    /*
    |--------------------------------------------------------------------------
    | Dynamic Filters (Scoped To Current Results)
    |--------------------------------------------------------------------------
    */

    // Categories
    $categoryIds = $productCollection

        ->pluck('categories')

        ->flatten()

        ->pluck('id')

        ->unique();

    $categories = ProductCategory::whereIn('id', $categoryIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('storeBrands', function ($b) use ($id) {

                    $b->where(
                        'store_brand_id',
                        $id
                    );

                });

            }
        ])

        ->having('products_count', '>', 0)

        ->get();

    // Brands
    $brandIds = $productCollection

        ->pluck('storeBrands')

        ->flatten()

        ->pluck('id')

        ->unique();

    $brands = StoreBrand::whereIn('id', $brandIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('storeBrands', function ($b) use ($id) {

                    $b->where(
                        'store_brand_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    // Sizes
    $sizeIds = $productCollection

        ->pluck('attributeTerms')

        ->flatten()

        ->filter(function ($term) {

            return optional($term->attribute)->slug === 'size';

        })

        ->pluck('id')

        ->unique();

    $sizes = AttributeTerm::whereIn('id', $sizeIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('storeBrands', function ($b) use ($id) {

                    $b->where(
                        'store_brand_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    // Colors
    $colorIds = $productCollection

        ->pluck('attributeTerms')

        ->flatten()

        ->filter(function ($term) {

            return optional($term->attribute)->slug === 'color';

        })

        ->pluck('id')

        ->unique();

    $colors = AttributeTerm::whereIn('id', $colorIds)

        ->withCount([
            'products' => function ($q) use ($id) {

                $q->whereHas('storeBrands', function ($b) use ($id) {

                    $b->where(
                        'store_brand_id',
                        $id
                    );

                });

            }
        ])

        ->get();

    /*
    |--------------------------------------------------------------------------
    | Min & Max Price
    |--------------------------------------------------------------------------
    */

    $allProducts = (clone $query)->get();

    $minPrice = $allProducts->min(
        'converted_regular_price'
    );

    $maxPrice = $allProducts->max(
        'converted_regular_price'
    );

    /*
    |--------------------------------------------------------------------------
    | Return Response
    |--------------------------------------------------------------------------
    */

    return response()->json([

        'success' => true,

        'html' => view(
            'brand.partials.products',
            compact('products')
        )->render(),

        'sidebar' => view(
            'brand.product_sidebar',
            compact(
                'categories',
                'brands',
                'sizes',
                'colors',
                'minPrice',
                'maxPrice'
            )
        )->render(),

        'nextPage' => $products->hasMorePages()
            ? $products->nextPageUrl()
            : null,

        'firstItem' => $products->firstItem(),

        'lastItem' => $products->lastItem(),

        'total' => $products->total(),
    ]);
}
}
