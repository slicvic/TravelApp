<?php
namespace App\Services\Expedia\Api;

use App\Services\Expedia\Api\Exceptions\InvalidResponseDataException;

abstract class ExpediaApiAbstractResponse implements ExpediaApiResponseInterface
{
    /**
     * HTTP status code.
     *
     * @var int
     */
    protected $status;

    /**
     * The body of the response (json encoded).
     *
     * @var string
     */
    protected $body;

    /**
     * The decoded body of the response.
     *
     * @var array
     */
    protected $decodedBody;

    /**
     * Constructor.
     * 
     * @param string $body A json encoded string.
     * @param int $status
     */
    public function __construct($body, int $status = 200)
    {
        $this->setStatus($status);
        $this->setBody($body);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody($body)
    {
        if (!is_string($body)) {
            throw new InvalidResponseDataException('Argument must be a json encoded string.');
        }

        $this->body = $body;

        $this->decodedBody = json_decode($body, true);
    }
}
