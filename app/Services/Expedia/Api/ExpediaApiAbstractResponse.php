<?php
namespace App\Services\Expedia\Api;

abstract class ExpediaApiAbstractResponse implements ExpediaApiResponseInterface
{
    /**
     * HTTP status code.
     * @var int
     */
    protected $status;

    /**
     * The data of the response.
     * @var array
     */
    protected $data;

    /**
     * Constructor.
     * @param string|array $data An array or a json encoded string
     * @param int $status
     */
    public function __construct($data, int $status = 200)
    {
        $this->setData($data);
        $this->setStatus($status);
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
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function setData($data)
    {
        if (is_string($data)) {
            $this->data = json_decode($data, true);
        } else {
            $this->data = $data;
        }

        return $this;
    }
}
