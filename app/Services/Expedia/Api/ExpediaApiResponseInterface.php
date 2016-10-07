<?php
namespace App\Services\Expedia\Api;

interface ExpediaApiResponseInterface
{
    /**
     * Get the HTTP status code.
     * @return int
     */
    public function getStatus();

    /**
     * Set the HTTP status code.
     * @param int $status
     * @return int
     */
    public function setStatus(int $status);

    /**
     * Get the data of the response.
     * @return array
     */
    public function getData();

    /**
     * Set the data of the response.
     * @param string|array $data An array or a json encoded string
     * @return $this
     */
    public function setData($data);
}
