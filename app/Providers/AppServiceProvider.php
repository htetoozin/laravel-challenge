<?php

namespace App\Providers;

use App\Services\InternetServiceProvider\OperatorInterface;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            OperatorInterface::class,
            Mpt::class,
            Ooredoo::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
