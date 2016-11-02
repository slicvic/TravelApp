<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;

use App\Http\Controllers\Ajax\BaseController;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiRequestParameters;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiService;

class AutoSuggestController extends BaseController
{
    /**
     * @var ExpediaSuggestionsApiService
     */
    private $suggestionsService;

    /**
     * Constructor.
     *
     * @param ExpediaSuggestionsApiService $suggestionsService
     */
    public function __construct(ExpediaSuggestionsApiService $suggestionsService)
    {
        $this->suggestionsService = $suggestionsService;
    }

    /**
     * Get list of regions with given criteria.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function regions(Request $request)
    {
        $input = $request->only(['query']);

        if (!$input['query']) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required parameter: query'
            ]);
        }

        $apiParameters = new ExpediaSuggestionsApiRequestParameters([
            'query' => $input['query'],
            'maxresults' => 10
        ]);

        $apiResponse = $this->suggestionsService->regions($apiParameters);

        $response = [
            'success' => true,
            'results' => $apiResponse->getResults()
        ];

        return response()->json($response);
    }
}
