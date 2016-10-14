<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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
        return view('hotels.index');
    }

    public function search(Request $request)
    {
        $input = $request->only([
            'region.id',
            'region.name',
            'region.airport_code',
            'check_in_date',
            'check_out_date',
            'rooms',
            'adults',
            'children',
            'children_ages'
        ]);

        $validator = Validator::make($input, [
            'region.id' => 'required',
            'region.name' => 'required',
            'region.airport_code' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required'
        ]);

        if ($validator->fails()) {
            // TODO
        }

        $apiParameters = new ExpediaHotelSearchApiRequestParameters([
            'city' => $input['region']['airport_code'],
            'checkInDate' => $input['check_in_date'],
            'checkOutDate' => $input['check_out_date'],
            'room' => [$input['adults'], $input['children_ages']],
            'resultsPerPage' => -1,
            'filterUnavailable' => true
        ]);

        $apiResponse = $this->hotelSearchService->search($apiParameters);

        return response()->json($apiResponse->getData());

        return view('hotels.search');
    }
}
