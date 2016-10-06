<?php
namespace App\Services\Expedia\Api;

abstract class ExpediaApiAbstractResponse
{
    /**
     * HTTP status code.
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $rawResponse;

    /**
     * @var stdClass
     */
    protected $rawResponseObject;

    /**
     * Constructor.
     * @param int    $status
     * @param string $body
     */
    public function __construct(int $status, string $body)
    {
        $this->status = $status;
        $this->rawResponse = $body;
        $this->rawResponseObject = $this->decodeJson($body);
    }

    /**
     * Get status.
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get rawResponse.
     * @return string
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * Get rawResponseObject.
     * @return stdClass
     */
    public function getRawResponseObject()
    {
        return $this->rawResponseObject;
    }

    /**
     * Decode a JSON string.
     * @param  string $json
     * @return stdClass
     */
    private function decodeJson(string $json)
    {
        return json_decode($json);
    }
}
