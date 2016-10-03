<?php
namespace App\Services\Expedia\Api\Response;

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
    protected $rawBody;

    /**
     * @var stdClass
     */
    protected $body;

    /**
     * Constructor.
     * @param int    $status
     * @param string $rawBody
     */
    public function __construct(int $status, string $rawBody)
    {
        $this->status = $status;
        $this->rawBody = $rawBody;
        $this->body = $this->decodeJsonResponse($rawBody);
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
     * Get rawBody.
     * @return string
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }

    /**
     * Get body.
     * @return stdClass
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Decode json response.
     * @param  return $jsonResponse
     * @return stdClass
     */
    private function decodeJsonResponse(string $jsonResponse)
    {
        return json_decode($jsonResponse);
    }
}
