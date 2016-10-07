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
     * Set a parameter.
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->setParameter($property, $value);
    }

    /**
     * Set a parameter.
     * @param string $name
     * @param mixed $value
     */
    public function setParameter($name, $value)
    {
        if (!array_key_exists($name, $this->parameters)) {
            return;
        }

        $this->parameters[$name] = $value;
    }

    /**
     * Set a group of parameters.
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        foreach ($parameters as $name => $value) {
            $this->setParameter($name, $value);
        }
    }

    /**
     * Convert parameters to URL query string.
     * @return array
     */
    public final function toQueryString()
    {
        $parameters = $this->parameters;
        $parameters['apikey'] = env('EXPEDIA_API_KEY');

        return http_build_query($parameters);
    }
}
