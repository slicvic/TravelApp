<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Services\Expedia\Api\ExpediaApiHttpClient;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiService;
use App\Services\Expedia\Api\Hotels\ExpediaHotelsApiService;
use App\Services\Expedia\Helpers\ExpediaHotelHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'hotels.partials.search-results-list-item', 'App\Http\ViewComposers\HotelSearchResultsListItem'
        );
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

        $this->app->singleton(ExpediaSuggestionsApiService::class, function($app) {
            return new ExpediaSuggestionsApiService($app->make(ExpediaApiHttpClient::class));
        });

        $this->app->singleton(ExpediaHotelsApiService::class, function($app) {
            return new ExpediaHotelsApiService($app->make(ExpediaApiHttpClient::class));
        });

        $this->app->singleton(ExpediaHotelHelper::class, function($app) {
            return new ExpediaHotelHelper;
        });

    }
}
