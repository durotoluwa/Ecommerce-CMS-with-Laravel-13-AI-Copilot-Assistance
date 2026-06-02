<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;
use Carbon\Carbon;
use App\Models\Currency;
use App\Models\Product;
use App\Models\BannerSlider;
use App\Models\Testimony;
use App\Models\BlogPost;


use App\Models\HomeCategorySection;

class HomepageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
view()->share('featuredcategorysection', ProductCategory::where('featured', true)->get());

view()->share('categorysection', ProductCategory::all());




 $displayCurrency = Currency::where('is_display', true)->first();


    view()->share('displayCurrency', $displayCurrency);

view()->share(
    'featuredproductsection',
    Product::with('categories')
           ->where('featured', true)
           ->where('status', true)
           ->get()
);

view()->share(
    'allproductsection',
    Product::with('categories')
           ->where('status', true)
           ->get()
);

view()->share(
        'alltestimony',
        Testimony::where('status', 'active')->get()
    );

    view()->share(
        'allblogpost',
        BlogPost::where('status', 'active')->get()
    );


view()->share(
    'newproductsection',
    Product::with('categories')
           ->where('status', true)
           ->where('created_at', '>=', Carbon::now()->subMonth())
           ->orderBy('created_at', 'desc')
           ->take(10)
           ->get()
);


view()->share(
    'featuredproductsection',
    Product::with('categories')
           ->where('status', true)
           ->where('featured', true)
           ->orderBy('created_at', 'desc')
           ->take(10)
           ->get()
);


$homesectionConfig = HomeCategorySection::first();

view()->share('categoryproductsection', function () use ($homesectionConfig) {
    $categoryId = $homesectionConfig->productsectionone_category;

    $query = Product::with('categories')->where('status', true);

    if ($categoryId !== 'all') {
        $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('id', $categoryId);
        });
    }

    return $query->orderBy('created_at', 'desc')->take(10)->get();
});


   View::composer('*', function ($view) {
            $sliders = BannerSlider::where('status', 1)->get();
            $view->with('bannerSliders', $sliders);
        });
 


view()->share(
    'newproductlist',
    Product::with('categories')
           ->where('status', true)
           ->where('created_at', '>=', Carbon::now()->subMonth())
           ->orderBy('created_at', 'desc')
           ->take(5)
           ->get()
);



     $config = HomeCategorySection::first();

    // Guard against null
    if (!$config) {
        view()->share('productTabs', []);
        return; // stop execution if no config
    }

    $tabs = [];

    for ($i = 1; $i <= 6; $i++) {
    $title     = $config->{'producttab'.$i.'_title'};
    $category  = $config->{'producttab'.$i.'_category'};
    $selection = $config->{'producttab'.$i.'_seletion'};
    $shoplink  = $config->{'producttab'.$i.'_shoplink'};

    $query = Product::with('categories')->where('status', true);

    // Filter by category if not "all"
    if ($category && $category !== 'all') {
        $query->whereHas('categories', function ($q) use ($category) {
            $q->where('product_category.id', $category);
        });
    }

    // Apply selection type
    if ($selection === 'featured') {
        $query->where('featured', true);   // <-- use 'featured' column
    } elseif ($selection === 'new') {
        $query->orderBy('created_at', 'desc');
    } else {
        $query->orderBy('id', 'desc'); // fallback for "all-product"
    }

    $tabs[$i] = [
        'title'    => $title,
        'products' => $query->take(8)->get(),
        'shoplink' => $shoplink,
    ];
}

view()->share('productTabs', $tabs);



    }




    
}
