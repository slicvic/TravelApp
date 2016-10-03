<?php
namespace App\Services\Expedia\Api\Response;

abstract class ExpediaApiAbstractResponse
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
