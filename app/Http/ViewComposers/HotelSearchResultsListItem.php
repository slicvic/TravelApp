<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Services\Expedia\Helpers\ExpediaHotelHelper;

class HotelSearchResultsListItem
{
    /**
     * @var ExpediaHotelHelper
     */
    protected $hotelHelper;

    /**
     * Constructor.
     *
     * @param ExpediaHotelHelper $hotelHelper
     */
    public function __construct(ExpediaHotelHelper $hotelHelper)
    {
        $this->hotelHelper = $hotelHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function compose(View $view)
    {
        $this->prepareData($view);
    }

    /**
     * Prepare data before rendering.
     *
     * @param View $view
     */
    private function prepareData(View $view)
    {
        $data = $view->getData();

        $data['hotel']['largeThumbnailUrl'] = $this->hotelHelper->imageUrl($data['hotel']['largeThumbnailUrl']);
        $data['hotel']['thumbnailUrl'] = $this->hotelHelper->imageUrl($data['hotel']['thumbnailUrl']);

        $view->with($data);
    }
}
