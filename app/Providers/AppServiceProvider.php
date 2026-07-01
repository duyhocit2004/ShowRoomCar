<?php

namespace App\Providers;

use App\Services\ListFormRegister\IListFormRegisterServices;
use App\Services\ListFormRegister\ListFormRegisterServices;
use App\Services\LocationShowroom\ILocationShowroomServices;
use App\Services\LocationShowroom\LocationShowroomServices;
use App\Services\News\INewsServices;
use App\Services\News\NewsServices;
use App\Services\Product\IProductServices;
use App\Services\Product\ProductServices;
use App\Services\TestDriverMethod\ITestDriverMethodServices;
use App\Services\TestDriverMethod\TestDriverMethodServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IListFormRegisterServices::class, ListFormRegisterServices::class);
        $this->app->bind(ITestDriverMethodServices::class, TestDriverMethodServices::class);
        $this->app->bind(IProductServices::class, ProductServices::class);
        $this->app->bind(ILocationShowroomServices::class, LocationShowroomServices::class);
        $this->app->bind(INewsServices::class, NewsServices::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
