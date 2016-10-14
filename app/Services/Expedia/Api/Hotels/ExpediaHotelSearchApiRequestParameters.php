<?php
namespace App\Services\Expedia\Api\Hotels;

use App\Services\Expedia\Api\ExpediaApiAbstractRequestParameters;

class ExpediaHotelSearchApiRequestParameters extends ExpediaApiAbstractRequestParameters
{
    /**
     * {@inheritdoc}
     */
    protected $required = [
        'city',
        'checkInDate',
        'checkOutDate'
    ];

    /**
     * {@inheritdoc}
     */
    protected $parameters = [
        /**
         * @var string
         */
         'city' => null,
        /**
         * @var string
         */
         'regionId' => null,
        /**
         * @var bool
         */
         'filterUnavailable' => false,
        /**
         * @var string
         */
         'filterHotelName' => null,
        /**
         * Used to filter by star rating.
         * Must be in increments of 5 and separated by commas(minStarRating=0 and maxStarRating=50).
         * Ex. '0,5,10' means 0, 0.5 and 1 star hotels
         * @var string
         */
         'filterStarRatings' => null,
        /**
         * Order to sort the list of hotels by Expedia picks, star rating, price and guest rating.
         * @var bool
         */
         'sortOrder' => true,
        /**
         * @var int
         */
         'resultsPerPage' => 25,
        /**
         * Check in date in ISO format (yyyy-MM-dd)
         * @var string
         */
         'checkInDate' => null,
        /**
         * Check out date in ISO format (yyyy-MM-dd)
         * @var string
         */
         'checkOutDate' => null,
         /**
          * [Optional if room1 field is specified] A Comma Separated Value of #OfAdults,
          * followed by children's ages for all children that are 18 and under.
          * If the child is under 1 then specify as 0. For example 2,12,2,3,0.
          * If it's just adults an example would be 2.
          * @var string
          */
         'room' => null
    ];

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        switch ($name) {
            case 'checkInDate':
            case 'checkOutDate':
                $value = date('Y-m-d', strtotime($value));
                break;

            case 'room':
                if (is_array($value)) {
                    if (count($value) === 2) {
                        $value[0] = (int) $value[0];
                        $value[1] = (array) $value[1];
                        $value = sprintf('%s%s',
                            $value[0],
                            (count($value[1])) ? ',' . implode(',', $value[1]) : ''
                        );
                    } else {
                        $value = '';
                    }
                }
                break;
        }

        parent::setParameter($name, $value);
    }
}
