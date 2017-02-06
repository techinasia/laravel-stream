<?php

namespace Techinasia\GetStream;

use Illuminate\Contracts\Config\Repository;
use InvalidArgumentException;

class StreamManager
{
    /** @var array */
    protected $clients = [];

    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    /** @var \Techinasia\GetStream\StreamFactory */
    protected $factory;

    /**
     * Constructs an instance of StreamManager.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Techinasia\GetStream\StreamFactory $factory
     */
    public function __construct(Repository $config, StreamFactory $factory)
    {
        $this->config = $config;
        $this->factory = $factory;
    }

    /**
     * Dynamically pass methods to the default application.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->application(), $method], $parameters);
    }

    /**
     * Retrieve an application instance.
     *
     * @param  mixed $name
     *
     * @return object
     */
    public function application($name = null)
    {
        $name = $name ?: $this->getDefaultApplication();

        if (! isset($this->clients[$name])) {
            $this->clients[$name] = $this->makeApplication($name);
        }

        return $this->clients[$name];
    }

    /**
     * Get the default application name.
     *
     * @return string
     */
    public function getDefaultApplication()
    {
        return $this->config->get($this->getConfigName().'.default');
    }

    /**
     * Set the default connection name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setDefaultApplication($name)
    {
        $this->config->set($this->getConfigName().'.default', $name);
    }

    /**
     * Make the application instance.
     *
     * @param  string $name
     *
     * @return mixed
     */
    protected function makeApplication($name)
    {
        $config = $this->getApplicationConfig($name);

        return $this->factory->make($config);
    }

    /**
     * Get application-specific config.
     *
     * @param  string $name
     *
     * @return array
     */
    protected function getApplicationConfig($name)
    {
        $name = $name ?: $this->getDefaultApplication();

        $applications = $this->config->get($this->getConfigName().'.applications');

        if (! is_array($config = array_get($applications, $name)) && ! $config) {
            throw new InvalidArgumentException("Application [$name] is not configured.");
        }

        $config['name'] = $name;

        return $config;
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'stream';
    }
}
