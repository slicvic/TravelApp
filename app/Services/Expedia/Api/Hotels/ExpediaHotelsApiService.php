<?php
namespace App\Services\Expedia\Api\Hotels;

use App\Services\Expedia\Api\ExpediaApiHttpClient;
use App\Services\Expedia\Api\Hotels\ExpediaHotelSearchApiRequestParameters;

class ExpediaHotelsApiService
{
    /**
     * @var ExpediaApiHttpClient
     */
    private $expediaApiHttpClient;

    /**
     * Constructor.
     * 
     * @param ExpediaApiHttpClient $expediaApiHttpClient
     */
    public function __construct(ExpediaApiHttpClient $expediaApiHttpClient)
    {
        $this->expediaApiHttpClient = $expediaApiHttpClient;
    }

    public function search(ExpediaHotelSearchApiRequestParameters $parameters)
    {
        $response = $this->expediaApiHttpClient->get(
            env('EXPEDIA_API_ENDPOINT_HOTELS_SEARCH'),
            $parameters
        );

        return $response;
    }
}
