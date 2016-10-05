<?php
namespace App\Services\Expedia\Api;

use App\Contracts\SuggestionServiceInterface;

use App\Services\Expedia\Api\Response\ExpediaSuggestionApiResponse;
use App\Services\Expedia\Api\Response\ExpediaApiGenericResponse;

class ExpediaSuggestionApiService implements SuggestionServiceInterface
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
     * Get cities suggestions.
     * @param  string  $query
     * @param  integer $maxResults
     * @return ExpediaSuggestionApiResponse
     */
    public function cities(string $query, int $maxResults = 10)
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
     * @return ExpediaSuggestionApiResponse
     */
    private function processResponse(ExpediaApiGenericResponse $genericResponse)
    {
        $response = new ExpediaSuggestionApiResponse(
            $genericResponse->getStatus(),
            $genericResponse->getRawResponse()
        );

        return $response;
    }
}
