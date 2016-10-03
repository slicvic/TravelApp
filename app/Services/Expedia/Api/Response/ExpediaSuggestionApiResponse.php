<?php
namespace App\Services\Expedia\Api\Response;

class ExpediaSuggestionApiResponse extends ExpediaApiAbstractResponse
{
    /**
     * @var array
     */
    public $results;

    /**
     * @var stdClass
     */
    public $rawResponse;
}
