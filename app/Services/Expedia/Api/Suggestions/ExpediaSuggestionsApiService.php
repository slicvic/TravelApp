<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Services\Expedia\Api\ExpediaApiResponse;
use App\Services\Expedia\Api\ExpediaApiHttpClient;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiResponse;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiRequestParameters;

class ExpediaSuggestionsApiService
{
    /**
     * @var ExpediaApiHttpClient
     */
    protected $expediaApiHttpClient;

    /**
     * Constructor.
     *
     * @param ExpediaApiHttpClient $expediaApiHttpClient
     */
    public function __construct(ExpediaApiHttpClient $expediaApiHttpClient)
    {
        $this->expediaApiHttpClient = $expediaApiHttpClient;
    }

    /**
     * Get hotels suggestions.
     *
     * @param  ExpediaSuggestionsApiRequestParameters $parameters
     * @return ExpediaSuggestionsApiResponse
     */
    public function hotels(ExpediaSuggestionsApiRequestParameters $parameters)
    {
        return $this->sendRequest(env('EXPEDIA_API_ENDPOINT_SUGGESTIONS_HOTELS'), $parameters);
    }

    /**
     * Get regions suggestions.
     *
     * @param  ExpediaSuggestionsApiRequestParameters $parameters
     * @return ExpediaSuggestionsApiResponse
     */
    public function regions(ExpediaSuggestionsApiRequestParameters $parameters)
    {
        return $this->sendRequest(env('EXPEDIA_API_ENDPOINT_SUGGESTIONS_REGIONS'), $parameters);
    }

    /**
     * Get flights suggestions.
     *
     * @param  ExpediaSuggestionsApiRequestParameters $parameters
     * @return ExpediaSuggestionsApiResponse
     */
    public function flights(ExpediaSuggestionsApiRequestParameters $parameters)
    {
        return $this->sendRequest(env('EXPEDIA_API_ENDPOINT_SUGGESTIONS_FLIGHTS'), $parameters);
    }

    /**
     * Perform HTTP request.
     * 
     * @param  string $url
     * @param  ExpediaSuggestionsApiRequestParameters $parameters
     * @return ExpediaSuggestionsApiResponse
     */
    private function sendRequest(string $url, ExpediaSuggestionsApiRequestParameters $parameters)
    {
        $response = $this->expediaApiHttpClient->get($url, $parameters);

        return (new ExpediaSuggestionsApiResponse($response->getBody(), $response->getStatus()));
    }
}
