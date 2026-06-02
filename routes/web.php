<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UserPermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\productAttributeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeTermController;
use App\Http\Controllers\Admin\ProductController;
 use App\Http\Controllers\Admin\MediaController;
 use App\Http\Controllers\Admin\CurrencyController;
 use App\Http\Controllers\Admin\CartController;
 use App\Http\Controllers\Admin\CheckoutController;
 use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CouponController;
 use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\HomePageSectionController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TestimonyController;
use App\Http\Controllers\userCartCOntroller;
use App\Http\Controllers\Admin\ShippingController;



/*
|--------------------------------------------------------------------------
| Welcome & Authentication
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('welcome', [UserController::class, 'homePage'])->name('welcome');


// routes/web.php
// routes/web.php
// routes/web.php
Route::get('/dynamic.css', function () {
    $config = getWebsiteConfig();
 $homeconfig = getHomeSection();

    // Prepare safe values
    $primaryColor    = $config->primary_color ?? '#333333';
    $secondaryColor  = $config->secondary_color ?? '#ffffff';
    $footerBgColor   = $config->footer_bgcolor ?? '#f8f8f8';
    $footerTitleColor= $config->footer_titlecolor ?? '#000000';
    $footerTextColor = $config->footer_textcolor ?? '#666666';
    $copywriteBg     = $config->copywrite_bg ?? '#222222';
    $copywriteText   = $config->copywrite_textcolor ?? '#ffffff';
    $menuBgColor     = $config->menu_bg ?? '#ffffff';
    $menuTextColor   = $config->menu_text ?? '#333333';
    $topheadBgColor  = $config->tophead_bg ?? '#f0f0f0';
 
    $textColor       = $config->text_color ?? '#000000';
    $linkColor       = $config->link_color ?? '#007bff';
    $linkHoverColor  = $config->link_hover_color ?? '#0056b3';
    $borderColor     = $config->border_color ?? '#dddddd';
    $backgroundColor = $config->background_color ?? '#ffffff';
    $headerBgColor   = $config->header_bg_color ?? '#ffffff';
    $footerTextColor2= $config->footer_text_color ?? '#666666';
    $headingColor= $config->heading_colour ?? '#666666';

    $bodyColor       = $config->body_color ?? $secondaryColor;
    $textFont        = $config->text_font ?? 'Poppins';
    $textWeight      = $config->text_weight ?? 400;
    $headingFont     = $config->heading_font_style ?? 'Poppins';
    $headingWeight   = $config->heading_weight ?? 600;
    
 
    $menuWeight      = $config->menu_weight ?? 500;
      $menuFont      = $config->menu_font ?? 'Poppins';
    $menuWeight    = $config->menu_weight ?? 500;
    $menuTextColor = $config->menu_text ?? '#333333';

      // Headertop CSS

       $headertopbgcolor= $homeconfig->header_bg_color ?? '#666666';
        $headertoptextcolor= $homeconfig->header_text_color ?? '#666666';

        // IconBox CSS
       $iconboxiconcolor= $homeconfig->iconbox_icon_color ?? '#666666';
        $iconboxheadingcolor= $homeconfig->iconbox_heading_color ?? '#666666';
         $iconboxtextcolor= $homeconfig->iconbox_text_color ?? '#666666';
         $iconboxiconsize= $homeconfig->iconbox_icon_size ?? 20;
         $iconboxheadingsize= $homeconfig->iconbox_heading_size ?? 18;
         $iconboxtextsize= $homeconfig->iconbox_text_size ?? 15;

         //section banner
         $sectionbannerheadingcolor= $homeconfig->sectionbanner_heading_color ?? '#666666';
          $sectionbannerheadingsize= $homeconfig->sectionbanner_heading_size ?? 20;
           $sectionbannerheadingfont     = $homeconfig->sectionbanner_heading_font ?? 'Poppins';

    // Build CSS
    $css = <<<CSS
    :root,
    [data-bs-theme='light'] {
        --primary-color: {$primaryColor};
        --secondary-color: {$secondaryColor};
        --footerbg-color: {$footerBgColor};
        --footertitle-color: {$footerTitleColor};
        --footertext-color: {$footerTextColor};
        --copywrite-bg-color: {$copywriteBg};
        --copywrite-text-color: {$copywriteText};

        --menubg-color: {$menuBgColor};
        --menutext-color: {$menuTextColor};
         --menu-font: {$menuFont};
          --menutext-weight: {$menuWeight};
        --topheadbg-color: {$topheadBgColor};
        --topheadtext-color: {$menuTextColor};
        --heading-color: {$headingColor};
        --text-font:'{$textFont}', sans-serif;
        --font-weight:{$textWeight};
        --headertop-bg-color:{$headertopbgcolor};
        --headertop-text-color:{$headertoptextcolor};

 

        --text-color: {$textColor};
        --link-color: {$linkColor};
        --link-hover-color: {$linkHoverColor};
        --border-color: {$borderColor};
        --background-color: {$backgroundColor};
        --header-bg-color: {$headerBgColor};
        --footer-text-color: {$footerTextColor2};

        --iconbox-icon-color: {$iconboxiconcolor};
        --iconbox-heading-color: {$iconboxheadingcolor};
        --iconbox-text-color: {$iconboxtextcolor};
        --iconbox-icon-size: {$iconboxiconsize}px;
        --iconbox-heading-size: {$iconboxheadingsize}px;
        --iconbox-text-size: {$iconboxtextsize}px;


        --section-banner-heading-color: {$sectionbannerheadingcolor};
        --section-banner-heading-size: {$sectionbannerheadingsize}px;
          --section-banner-heading-font: {$sectionbannerheadingfont};
    }

    body {
        color: {$textColor};
        background-color: {$bodyColor};
        font-family: '{$textFont}', sans-serif;
        font-weight: {$textWeight};
       
    }

    .container{
         padding-left:10px;
         padding-right:10px;

    }

    h1, h2, h3, h4, h5, h6 {
        font-family: '{$headingFont}', sans-serif;
        font-weight: {$headingWeight};
        color: {$headingColor};
    }

 
    
    CSS;

    return response($css)->header('Content-Type', 'text/css');
});





// Login redirect logic
Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('user')) {
            return redirect()->route('dashboard');
        }

        Auth::logout();
        return redirect('/login');
    }
    return app(\App\Http\Controllers\Auth\AuthenticatedSessionController::class)->create();
})->name('login');

// User login/register/logout
Route::get('/user/login', [AuthController::class, 'showUserLogin'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'handleUserLogin'])->name('user.login.post');
Route::post('/user/register', [AuthController::class, 'userRegister'])->name('user.register');
Route::post('/user/logout', [AuthController::class, 'userLogout'])->name('user.logout');
Route::post('/logout', [AuthController::class, 'userLogout'])->name('user.logout');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| Cart & Checkout
|--------------------------------------------------------------------------




*/
Route::get('/cart', [userCartCOntroller::class, 'index'])->name('cart.index');
Route::get('/cart/removecart/{cartKey}', [userCartCOntroller::class, 'removecart'])->name('cart.removecart');
Route::post('/cart/updatecart', [userCartCOntroller::class, 'updatecart'])->name('cart.updatecart');

//Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{cartKey}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::view('/checkout/paystack', 'checkout.paystack')->name('checkout.paystack');
Route::get('/checkout/paystack/callback/{order}', [CheckoutController::class, 'paystackCallback'])->name('paystack.callback');
Route::post('/checkout/store-order', [CheckoutController::class, 'storeOrder'])
    ->middleware('auth:customer')
    ->name('checkout.storeOrder');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');
Route::post('/checkout/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('checkout.removeCoupon');

/*
|--------------------------------------------------------------------------
| Shop & Product Browsing
|--------------------------------------------------------------------------
*/
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/brand/{slug}', [ShopController::class, 'showBrand'])->name('brand.index');
Route::get('/product-category/{slug}', [ShopController::class, 'showCategory'])->name('product-category.index');

Route::match(['get','post'], '/shop/filter/categories', [ShopController::class, 'filterByCategories'])->name('shop.filter.categories');
Route::match(['get','post'], '/category/{id?}/filter', [ShopController::class, 'filterByCategoryPage'])->name('category.filter');
Route::match(['get','post'], '/brand/{id?}/filter', [ShopController::class, 'filterBybrandPage'])->name('brand.filter');

Route::get('/search/products', [CartController::class, 'search'])->name('products.search');
Route::get('/search/products', [ProductController::class, 'search'])->name('products.search');

Route::get('/product/{slug}', [ProductController::class, 'showdetails'])->name('product.details');
Route::get('/product/{id}/quickview', [UserController::class, 'quickView'])->name('product.quickview');

/*
|--------------------------------------------------------------------------
| CMS Pages & Blog
|--------------------------------------------------------------------------
*/
Route::get('/page/{slug}', [UserController::class, 'showPage'])->name('page.show');
Route::get('/blog/{slug}', [UserController::class, 'showBlog'])->name('blog.show');

/*
|--------------------------------------------------------------------------
| Admin Utility (CSV Sample)
|--------------------------------------------------------------------------
*/
Route::get('admin/products/sample-csv', [ProductController::class, 'downloadSampleCsv'])->name('admin.products.sample.csv');





/*
|--------------------------------------------------------------------------
| Customer Account & Profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:customer'])->group(function () {

    // Dashboard
    Route::get('/myaccount', [UserController::class, 'userDashboard'])->name('myaccount.index');

    // Billing & Profile
    Route::post('/billing', [UserController::class, 'update'])->name('billing.update');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.changePassword');

    /*
    |--------------------------------------------------------------------------
    | Shipping Address
    |--------------------------------------------------------------------------
    */
    Route::post('/shipping-address/store', [ShippingAddressController::class, 'store'])->name('shipping.store');
    Route::post('/shipping-address/choose/{id}', [ShippingAddressController::class, 'choose'])->name('shipping.choose');
    Route::put('/shipping-address/{id}', [ShippingAddressController::class, 'update'])->name('shipping.update');
    Route::delete('/shipping-address/{id}', [ShippingAddressController::class, 'destroy'])->name('shipping.delete');

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */
    Route::get('/order/{order}', [UserController::class, 'show'])->name('order.details');

    /*
    |--------------------------------------------------------------------------
    | Wishlist
    |--------------------------------------------------------------------------
    */
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
});





 
 Route::middleware(['role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin User Management
    |--------------------------------------------------------------------------
    */
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::put('admin/users/{id}', [AdminUserController::class, 'updateadminUser'])->name('admin.users.update');
    Route::post('admin/staff/create', [AdminUserController::class, 'storeAdminUser'])->name('createstaff');
    Route::put('admin/users/{id}/password', [AdminUserController::class, 'adminchangePassword'])->name('change_password');
    Route::delete('admin/users/{id}', [AdminUserController::class, 'destroy'])->name('delete_user');
    Route::put('admin/profile/{id}', [AdminUserController::class, 'updateProfile'])->name('adminupdateprofile');
    Route::get('admin/admin_user/{id}', [AdminUserController::class, 'adminprofile'])->name('admin.admin_user.myprofile');

    /*
    |--------------------------------------------------------------------------
    | Menu Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::post('/menus/store', [MenuController::class, 'store'])->name('menus.store');
        Route::post('/menus/update/{id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/menus/delete/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::post('/menus/sort', [MenuController::class, 'sort'])->name('menus.sort');
        Route::get('/menus/tree', [MenuController::class, 'tree'])->name('menus.tree');
        Route::get('/menus/references/{type}', [MenuController::class, 'references'])->name('menus.references');
    });

    /*
    |--------------------------------------------------------------------------
    | Footer Management
    |--------------------------------------------------------------------------
    */
    Route::get('admin/footer/edit', [FooterController::class, 'edit'])->name('admin.footer.edit');
    Route::put('admin/footer/update', [FooterController::class, 'update'])->name('admin.footer.update');

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('menus/{menu}/items', [MenuItemController::class, 'index'])->name('menu-items.index');
        Route::get('menus/{menu}/items/create', [MenuItemController::class, 'create'])->name('menu-items.create');
        Route::post('menus/{menu}/items', [MenuItemController::class, 'store'])->name('menu-items.store');
        Route::get('menu-items/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('menu-items.edit');
        Route::put('menu-items/{menuItem}', [MenuItemController::class, 'update'])->name('menu-items.update');
        Route::delete('menu-items/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
        Route::post('menus/items/reorder', [MenuItemController::class, 'reorder'])->name('menu-items.reorder');
    });

    /*
    |--------------------------------------------------------------------------
    | Content Management
    |--------------------------------------------------------------------------
    */
    Route::resource('admin/banner_sliders', BannerSliderController::class);
    Route::resource('admin/blog_category', BlogCategoryController::class);

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::resource('blog', BlogController::class);
        Route::get('/admin/blog/{blog:slug}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    });

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::resource('pages', PageController::class);
        Route::get('/admin/pages/{pages:slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
    });

    Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

    Route::prefix('admin')->group(function () {
    Route::resource('testimonies', TestimonyController::class);
});

    /*
    |--------------------------------------------------------------------------
    | Homepage Sections
    |--------------------------------------------------------------------------
    */

    Route::get('/homepage/header_top', [HomePageSectionController::class, 'HeadertopSection'])->name('admin.homepage.header_top');
    Route::put('/admin/homepage/header_top/{id}', [HomePageSectionController::class, 'updateHeadertopSection'])->name('header_top.update');


    Route::get('/homepage/categorysection', [HomePageSectionController::class, 'CategorySection'])->name('admin.homepage.categorysection');
    Route::put('/admin/homepage/categorysection/{id}', [HomePageSectionController::class, 'updatecategorySection'])->name('home-category-section.update');


    Route::get('/homepage/testimonysection', [HomePageSectionController::class, 'testimonySection'])->name('admin.homepage.testimonysection');
    Route::put('/admin/homepage/testimonysection/{id}', [HomePageSectionController::class, 'updatetestimonySection'])->name('testimonysection.update');

       Route::get('/homepage/blogsection', [HomePageSectionController::class, 'blogSection'])->name('admin.homepage.blogsection');
    Route::put('/admin/homepage/blogsection/{id}', [HomePageSectionController::class, 'updateblogSection'])->name('blogsection.update');

    


    Route::get('/homepage/sectionbanner', [HomePageSectionController::class, 'SectionBanner'])->name('admin.homepage.sectionbanner');
    Route::put('/admin/homepage/sectionbanner/{id}', [HomePageSectionController::class, 'updateSectionBanner'])->name('sectionbanner.update');

    Route::get('/homepage/actionbox', [HomePageSectionController::class, 'Actionbox'])->name('admin.homepage.actionbox');
    Route::put('/admin/homepage/actionbox/{id}', [HomePageSectionController::class, 'updateActionbox'])->name('actionbox.update');

    Route::get('/homepage/product_section_one', [HomePageSectionController::class, 'productSectionOne'])->name('admin.homepage.product_section_one');
    Route::put('/admin/homepage/product_section_one/{id}', [HomePageSectionController::class, 'updateProductsecone'])->name('product_section_one.update');

    Route::get('/homepage/sectionbanner2', [HomePageSectionController::class, 'cardboxPage'])->name('admin.homepage.sectionbanner2');
    Route::put('/admin/homepage/sectionbanner2/{id}', [HomePageSectionController::class, 'updateCardBoxes'])->name('cardbox.update');

    Route::get('/homepage/producttab', [HomePageSectionController::class, 'productTabPage'])->name('admin.homepage.producttab');
    Route::put('/admin/homepage/producttab/{id}', [HomePageSectionController::class, 'updateProductTabs'])->name('producttab.update');


   /*
    |--------------------------------------------------------------------------
    | Shipping Settings
    |--------------------------------------------------------------------------
    */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('zones', ShippingController::class, [
        'parameters' => ['zones' => 'shippingZone']
    ]);

    Route::post('zones/{shippingZone}/location', [ShippingController::class, 'storeLocation'])
        ->name('zones.location.store');

    Route::post('zones/{shippingZone}/method', [ShippingController::class, 'storeMethod'])
        ->name('zones.method.store');

  Route::delete('zones/{shippingZone}/method/{method}', [ShippingController::class, 'destroyMethod'])
        ->name('zones.method.destroy');

    Route::delete('zones/{shippingZone}/location/{location}', [ShippingController::class, 'destroyLocation'])
        ->name('zones.location.destroy');

});








    /*
    |--------------------------------------------------------------------------
    | Coupons & Dashboard
    |--------------------------------------------------------------------------
    */
    Route::resource('coupons', CouponController::class);
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Orders & Payments
    |--------------------------------------------------------------------------
    */ Route::get('/product_orders', [ProductController::class, 'OrderPage'])->name('admin.product_orders.index');
    Route::get('/product_orders/{id}', [ProductController::class, 'showproductOrder'])->name('admin.product_orders.show');
    Route::get('/product_orders/pending_product', [ProductController::class, 'pendingOrder'])->name('admin.product_orders.pending_product');
    Route::get('/payment/paystack', [PaymentController::class, 'paysatckPage'])->name('admin.payment.paystack');
    Route::put('/paystack/update', [PaymentController::class, 'updatepaystack'])->name('admin.paystack.update');

    Route::delete('admin/products/bulk-delete', [ProductController::class, 'bulkDelete'])
    ->name('admin.products.bulkDelete');


    /*
    |--------------------------------------------------------------------------
    | Permissions & Roles
    |--------------------------------------------------------------------------
    */
    Route::middleware(['permission:assign role and permission'])->group(function () {
        Route::resource('permissions', PermissionController::class);
        Route::get('/role-permissions', [RolePermissionController::class, 'index'])->name('role_permissions.index');
        Route::post('/role-permissions', [RolePermissionController::class, 'store'])->name('role_permissions.store');
        Route::get('/admin/user-permissions', [UserPermissionController::class, 'index'])->name('user_permissions.index');
        Route::post('/admin/user-permissions', [UserPermissionController::class, 'store'])->name('user_permissions.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Media Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
        Route::post('/media/bulk-delete', [MediaController::class, 'bulkDelete'])->name('admin.media.bulkDelete');
    });
    Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    */
    Route::middleware(['permission:website configuration'])->group(function () {
        Route::get('configuration/cookie', [ConfigurationController::class, 'cookiesPage'])->name('admin.configuration.cookie');
        Route::put('/updateCookies', [ConfigurationController::class, 'updateCookies'])->name('updateCookies');

        Route::get('configuration/errorpage', [ConfigurationController::class, 'errorPage'])->name('admin.configuration.errorpage');
        Route::put('/updateErrorPage', [ConfigurationController::class, 'updateErrorPage'])->name('updateErrorPage');
 Route::get('configuration/breadcrumb', [ConfigurationController::class, 'breadcrumbPage'])->name('admin.configuration.breadcrumb');
        Route::put('/updateBreadcrumb', [ConfigurationController::class, 'updateBreadcrumb'])->name('updateBreadcrumb');
         Route::get('configuration/avatar', [ConfigurationController::class, 'avatarPage'])->name('admin.configuration.avatar');
        Route::put('/updateAvatar', [ConfigurationController::class, 'updateAvatar'])->name('updateAvatar');
        Route::get('configuration/maintenance', [ConfigurationController::class, 'maintenancePage'])->name('admin.configuration.maintenance');
        Route::put('/updateMaintenance', [ConfigurationController::class, 'updateMaintenance'])->name('updateMaintenance');
        Route::get('email/configuration', [ConfigurationController::class, 'emailpage'])->name('admin.email.configuration');
        Route::put('/updateEmail', [ConfigurationController::class, 'updateEmail'])->name('updateEmail');
        Route::get('configuration/tawkto', [ConfigurationController::class, 'tawktoPage'])->name('admin.configuration.tawkto');
        Route::put('/updateTawkto', [ConfigurationController::class, 'updateTawkto'])->name('updateTawkto');
        Route::get('configuration/websiteLogo', [ConfigurationController::class, 'websiteLogo'])->name('admin.configuration.websiteLogo');
        Route::put('updateWebsiteLogo/{websiteconfig}', [ConfigurationController::class, 'updateWebsiteLogo'])->name('updateWebsiteLogo');
        Route::get('configuration/websitecolor', [ConfigurationController::class, 'websiteColor'])->name('admin.configuration.websitecolor');
        Route::put('/updateWebsiteColor', [ConfigurationController::class, 'updateWebsiteColor'])->name('updateWebsiteColor');
        Route::get('configuration/contact', [ConfigurationController::class, 'contactpage'])->name('admin.configuration.contact');
        Route::put('/updateContact', [ConfigurationController::class, 'updateContact'])->name('updateContact');
        Route::get('configuration/footer', [ConfigurationController::class, 'footerPage'])->name('admin.configuration.footer');
        Route::put('/updateFooter', [ConfigurationController::class, 'updateFooter'])->name('updateFooter');
        Route::get('configuration/menu', [ConfigurationController::class, 'menuPage'])->name('admin.configuration.menu');
        Route::put('/updateMenu', [ConfigurationController::class, 'updateMenu'])->name('updateMenu');
Route::get('configuration/seopage', [ConfigurationController::class, 'seoPage'])->name('admin.configuration.seopage');
Route::put('/updateseoPage', [ConfigurationController::class, 'updateseoPage'])->name('updateseoPage');
    });

  /*
|--------------------------------------------------------------------------
| Product Management
|--------------------------------------------------------------------------
*/
Route::middleware(['permission:product section'])->group(function () {

    // Tags
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('tags', TagController::class);
    });

    // Brands
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('brands', BrandController::class);
    });

    // Product Categories
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('product_categories', ProductCategoryController::class);
    });

    // Toggle Featured Category
    Route::prefix('admin/category')->group(function () {
        Route::post('/{productcategory}/toggle-featured',
            [App\Http\Controllers\Admin\ProductCategoryController::class, 'categorytoggleFeatured']
        )->name('admin.category.toggleFeatured');
    });

    // Attributes & Terms
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('attributes', AttributeController::class);

        Route::prefix('attributes/{attribute}')->group(function () {
            Route::get('terms', [AttributeTermController::class, 'index'])->name('attribute_terms.index');
            Route::post('terms', [AttributeTermController::class, 'store'])->name('attribute_terms.store');
            Route::get('terms/{term}/edit', [AttributeTermController::class, 'edit'])->name('attribute_terms.edit');
            Route::put('terms/{term}', [AttributeTermController::class, 'update'])->name('attribute_terms.update');
            Route::delete('terms/{term}', [AttributeTermController::class, 'destroy'])->name('attribute_terms.destroy');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Product Creation & Management
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::post('/admin/products/{attribute}/terms', [ProductController::class, 'storeTerm']);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('admin/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');

Route::post('admin/products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])
    ->name('admin.products.toggleFeatured');

Route::get('admin/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
Route::get('admin/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');

Route::delete('/admin/products/{product}/gallery/{gallery}', 
    [ProductController::class, 'destroyGallery']
)->name('admin.products.gallery.destroyimage');

// Import Products
Route::get('/products/import', [ProductController::class, 'showImportForm'])->name('admin.products.import');
Route::post('admin/products/import', [ProductController::class, 'import'])->name('admin.products.import.store');

/*
|--------------------------------------------------------------------------
| Currency Management
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('currencies', CurrencyController::class);
});



});
// ============ADMIN auth routes


require __DIR__.'/auth.php';
