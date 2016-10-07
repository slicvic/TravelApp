<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;

use App\Http\Controllers\Ajax\BaseController;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiRequestParameters;
use App\Services\Expedia\Api\Suggestions\ExpediaSuggestionsApiService;

class AutoSuggestController extends BaseController
{
    private $suggestionsService;

    public function __construct(ExpediaSuggestionsApiService $suggestionsService)
    {
        $this->suggestionsService = $suggestionsService;
    }

    public function regions(Request $request)
    {
        $input = $request->only(['query']);

        if (!$input['query']) {
            return response()->json([
                'success' => 0,
                'message' => 'Missing required parameter: query'
            ]);
        }

        $apiParameters = new ExpediaSuggestionsApiRequestParameters([
            'query' => $input['query'],
            'maxresults' => 10
        ]);

        $apiResponse = $this->suggestionsService->regions($apiParameters);

        $response = [
            'success' => 1,
            'results' => $apiResponse->getData()
        ];

        return response()->json($response);
    }
}
