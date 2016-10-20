<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\BaseController;
use App\Http\Requests\HotelSearchFormRequest;
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
        return view('hotels.index');
    }

    public function search(HotelSearchFormRequest $request)
    {
        $input = $request->only([
            'region.id',
            'region.name',
            'region.airport_code',
            'checkin_date',
            'checkout_date',
            'rooms',
            'adults',
            'children',
            'children_ages'
        ]);

        $apiParameters = new ExpediaHotelSearchApiRequestParameters([
            'city' => $input['region']['airport_code'],
            'checkInDate' => $input['checkin_date'],
            'checkOutDate' => $input['checkout_date'],
            'room' => [$input['adults'], $input['children_ages']],
            'resultsPerPage' => -1,
            'filterUnavailable' => true
        ]);

        $apiResponse = $this->hotelSearchService->search($apiParameters);

        if ($request->get('debug')) {
            var_dump($apiResponse->getData());
        }

        return view('hotels.search', [
            'data' => $apiResponse->getData()
        ]);
    }
}
