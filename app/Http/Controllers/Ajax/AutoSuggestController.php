<?php
namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;

use App\Http\Controllers\Ajax\BaseController;
use App\Contracts\SuggestionsServiceInterface;

class AutoSuggestController extends BaseController
{
    private $suggestionsService;

    public function __construct(SuggestionsServiceInterface $suggestionsService)
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

        $data = $this->suggestionsService->regions($input['query']);

        $response = [
            'success' => 1,
            'results' => $data->getResults()
        ];

        return response()->json($response);
    }
}
