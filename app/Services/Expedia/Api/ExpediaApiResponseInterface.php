<?php
namespace App\Services\Expedia\Api;

interface ExpediaApiResponseInterface
{
    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set the HTTP status code.
     *
     * @param int $status
     * @return int
     */
    public function setStatus(int $status);

    /**
     * Get the body of the response.
     *
     * @return string A json encoded string
     */
    public function getBody();

    /**
     * Get the decoded body of the response.
     *
     * @return array
     */
    public function getDecodedBody();

    /**
     * Set the body of the response.
     * 
     * @param string $body A json encoded string
     * @return $this
     */
    public function setBody($body);
}
