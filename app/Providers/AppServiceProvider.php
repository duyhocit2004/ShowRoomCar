<?php

namespace App\Providers;

use App\Services\ListFormRegister\IListFormRegisterServices;
use App\Services\ListFormRegister\ListFormRegisterServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IListFormRegisterServices::class, ListFormRegisterServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
