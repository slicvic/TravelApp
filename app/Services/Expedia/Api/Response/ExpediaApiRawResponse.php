<?php
namespace App\Services\Expedia\Api\Response;

class ExpediaApiRawResponse extends ExpediaApiAbstractResponse
{
    /**
     * HTTP status code.
     * @var int
     */
    public $status;

    /**
     * @var object
     */
    public $body;
}
