<?php
namespace App\Services\Expedia\Api;

abstract class ExpediaApiAbstractRequestParameters
{
    /**
     * List of required parameters.
     * @var array
     */
    protected $required = [];

    /**
     * List of parameter key/value pairs.
     * @var array
     */
    protected $parameters = [];

    /**
     * Constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->setParameters($parameters);
    }

    /**
     * Set parameters.
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        if (!array_key_exists($property, $this->parameters)) {
            return;
        }

        $this->parameters[$property] = $value;
    }

    /**
     * Convert parameters to URL query string.
     * @return array
     */
    public final function toQueryString()
    {
        $this->parameters['apikey'] = env('EXPEDIA_API_KEY');

        return http_build_query($this->parameters);
    }

    /**
     * Set the parameters.
     * @param array $parameters
     */
    private function setParameters(array $parameters)
    {
        foreach ($parameters as $property => $value) {
            $this->$property = $value;
        }
    }
}
