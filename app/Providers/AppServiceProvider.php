<?php

namespace App\Providers;

use App\Service\MovieService;
use App\Service\MovieServiceInterface;
use App\Service\OmdbApiService;
use App\Service\OmdbApiServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OmdbApiServiceInterface::class, OmdbApiService::class);
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
