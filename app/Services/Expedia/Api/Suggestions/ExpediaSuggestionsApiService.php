<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Contracts\SuggestionsServiceInterface;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiResponse;
use App\Services\Expedia\Api\ExpediaApiGenericResponse;
use App\Services\Expedia\Api\ExpediaApiHttpClient;

class ExpediaSuggestionsApiService implements SuggestionsServiceInterface
{
    /**
     * @var ExpediaApiHttpClient
     */
    protected $expediaApiHttpClient;

    /**
     * Constructor.
     * @param ExpediaApiHttpClient $expediaApiHttpClient
     */
    public function __construct(ExpediaApiHttpClient $expediaApiHttpClient)
    {
        $this->expediaApiHttpClient = $expediaApiHttpClient;
    }

    /**
     * Get hotels suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionsApiResponse
     */
    public function hotels(string $query, int $maxResults = 10)
    {
        return $this->sendRequest('hotels', $query, $maxResults);
    }

    /**
     * Get regions suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionsApiResponse
     */
    public function regions(string $query, int $maxResults = 10)
    {
        return $this->sendRequest('regions', $query, $maxResults);
    }

    /**
     * Get flights suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionsApiResponse
     */
    public function flights(string $query, int $maxResults = 10)
    {
        return $this->sendRequest('flights', $query, $maxResults);
    }

    /**
     * Perform HTTP request.
     * @param  string $resource
     * @param  string $query
     * @param  int    $maxResults
     * @return ExpediaSuggestionsApiResponse
     */
    private function sendRequest(string $resource, string $query, int $maxResults)
    {
        $url = env('EXPEDIA_API_ENDPOINT_SUGGESTIONS_URL') . $resource;

        $data = [
            'query' => $query,
            'maxresults' => $maxResults
        ];

        $response = $this->expediaApiHttpClient->get($url, $data);

        return $this->processResponse($response);
    }

    /**
     * Process response.
     * @param  ExpediaApiGenericResponse $genericResponse
     * @return ExpediaSuggestionsApiResponse
     */
    private function processResponse(ExpediaApiGenericResponse $genericResponse)
    {
        $response = new ExpediaSuggestionsApiResponse(
            $genericResponse->getStatus(),
            $genericResponse->getRawResponse()
        );

        return $response;
    }
}
