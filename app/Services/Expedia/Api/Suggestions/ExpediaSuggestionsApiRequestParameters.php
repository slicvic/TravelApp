<?php
namespace App\Services\Expedia\Api\Suggestions;

use App\Services\Expedia\Api\ExpediaApiAbstractRequestParameters;

class ExpediaSuggestionsApiRequestParameters extends ExpediaApiAbstractRequestParameters
{
    /**
     * {@inheritdoc}
     */
    protected $required = [
        'query'
    ];

    /**
     * {@inheritdoc}
     */
    protected $parameters = [
        /**
         * @var string
         */
        'query' => null,
        /**
         * @var int
         */
        'maxresults' => 10
    ];
}
