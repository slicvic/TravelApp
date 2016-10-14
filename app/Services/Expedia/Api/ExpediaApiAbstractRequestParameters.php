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
     * List of parameter name/value pairs.
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
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->setParameter($name, $value);
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
        return http_build_query($this->parameters);
    }
}
