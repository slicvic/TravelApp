<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\SuggestionsServiceInterface;
use App\Services\Expedia\Api\ExpediaApiHttpClient;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiService;
//use App\Services\Expedia\Api\Hotels\ExpediaHotelsApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ExpediaApiHttpClient::class, function($app) {
            return new ExpediaApiHttpClient();
        });

        $this->app->singleton(SuggestionsServiceInterface::class, function($app) {
            return new ExpediaSuggestionsApiService($app->make(ExpediaApiHttpClient::class));
        });

        $this->app->singleton(ExpediaHotelsApiService::class, function($app) {
            return 'xxxx';
        });
    }
}
