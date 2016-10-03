<?php
namespace App\Http\Controllers;

use App\Services\Expedia\Api\ExpediaSuggestionApiService;

class HomeController extends Controller
{
    protected $expediaSuggestionsApiService;

    public function __construct(ExpediaSuggestionApiService $expediaSuggestionsApiService)
    {
        $this->expediaSuggestionsApiService = $expediaSuggestionsApiService;
    }
    public function index()
    {
        dd($this->expediaSuggestionsApiService->hotels('hilton'));exit;

        return view('home');
    }
}
