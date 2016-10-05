<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Expedia\Api\ExpediaSuggestionApiService;
use App\Services\Expedia\Api\ExpediaApiHttpClient;
use App\Contracts\SuggestionServiceInterface;

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

        $this->app->singleton(SuggestionServiceInterface::class, function($app) {
            return new ExpediaSuggestionApiService($app->make(ExpediaApiHttpClient::class));
        });
    }
}
