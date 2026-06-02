<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\PaystackService;
use App\Models\WebsiteConfig;
use App\Models\HomeCategorySection;
use App\Models\FooterSetting;

 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
  public function register(): void
{
    $this->app->singleton(PaystackService::class, function ($app) {
        return new PaystackService();
    });
}

    /**
     * Bootstrap any application services.
     */
       public function boot()
{
    view()->composer('*', function ($view) {
        $view->with('paystack', app(PaystackService::class));
    });

$config = WebsiteConfig::first();
View::share('websiteConfig', $config);

$homeconfig = HomeCategorySection::first();
View::share('homesectionConfig', $homeconfig);

 View::composer('*', function ($view) {
        $footer = FooterSetting::first();
        $view->with('footer', $footer);
    });

}

}
