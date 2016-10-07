<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Expedia\Api\Hotels\ExpediaHotelsApiService;
use App\Services\Expedia\Api\Hotels\ExpediaHotelSearchApiRequestParameters;

class HotelsController extends BaseController
{
    private $hotelSearchService;

    public function __construct(ExpediaHotelsApiService $hotelSearchService)
    {
        $this->hotelSearchService = $hotelSearchService;
    }

    public function index()
    {
        $apiParameters = new ExpediaHotelSearchApiRequestParameters();
        $apiParameters->city = 'MIA';
        $apiParameters->checkInDate = '2016-10-20';
        $apiParameters->checkOutDate = '2016-10-25';
        $apiParameters->room1 = 2;

        $apiResponse = $this->hotelSearchService->search($apiParameters);
        //echo $apiParameters->toQueryString();exit;
        return response()->json($apiResponse->getRawResponse());

        //exit;
        return view('hotels.index');
    }

    public function search()
    {
        return view('hotels.search');
    }
}
