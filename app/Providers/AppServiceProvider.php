<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Expedia\ExpediaSuggestionApiService;
use App\Services\Expedia\ExpediaApiHttpClient;

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
        $this->app->singleton(ExpediaSuggestionApiService::class, function($app) {
            return new ExpediaSuggestionApiService();
        });

        $this->app->singleton(ExpediaApiHttpClient::class, function($app) {
            return new ExpediaApiHttpClient();
        });
    }
}
