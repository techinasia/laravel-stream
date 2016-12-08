<?php

namespace Techinasia\GetStream;

use GetStream\Stream\Client;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class StreamFactory
{
    /**
     * Create an application instance.
     *
     * @param  array $config
     *
     * @return mixed
     */
    public function make(array $config)
    {
        $config = $this->parseConfig($config);

        return $this->makeClient($config['key'], $config['secret']);
    }

    /**
     * Parse and check config required to create the client.
     *
     * @throws InvalidArgumentException
     *
     * @param  array $config
     *
     * @return array
     */
    protected function parseConfig(array $config)
    {
        if (empty($config['key']) || empty($config['secret'])) {
            throw new InvalidArgumentException(
                sprintf(
                    'Application [%s] is not configured correctly.',
                    Arr::get($config, 'name', '')
                )
            );
        }

        return Arr::only($config, ['key', 'secret']);
    }

    /**
     * Returns a new instance of the client.
     *
     * @param  string $key
     * @param  string $secret
     *
     * @return mixed
     */
    protected function makeClient($key, $secret)
    {
        return new Client($key, $secret);
    }
}
