<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\Response\ExpediaSuggestionApiResponse;
use App\Services\Expedia\Api\Response\ExpediaApiRawResponse;

class ExpediaSuggestionApiService
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
     * @return ExpediaSuggestionApiResponse
     */
    public function hotels(string $query, int $maxResults = 10)
    {
        return $this->sendRequest('hotels', $query, $maxResults);
    }

    /**
     * Get regions suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionApiResponse
     */
    public function regions(string $query, int $maxResults = 10)
    {
        return $this->sendRequest('regions', $query, $maxResults);
    }

    /**
     * Get flights suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionApiResponse
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
     * @return ExpediaSuggestionApiResponse
     */
    protected function sendRequest(string $resource, string $query, int $maxResults)
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
     * Take raw response and extract search results.
     * @param  ExpediaApiRawResponse $rawResponse
     * @return ExpediaSuggestionApiResponse
     */
    protected function processResponse(ExpediaApiRawResponse $rawResponse)
    {
        $response = new ExpediaSuggestionApiResponse();
        $response->rawResponse = $rawResponse;
        $response->results = [];

        if ($rawResponse->status != 200 || !$rawResponse->body) {
            return $response;
        }

        if ($rawResponse->body->rc != 'OK' || empty($rawResponse->body->sr)) {
            return $response;
        }

        $response->results = $rawResponse->body->sr;

        return $response;
    }
}
