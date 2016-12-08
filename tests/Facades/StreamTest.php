<?php

namespace Techinasia\GetStream\Tests\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Techinasia\GetStream\Facades\Stream;
use Techinasia\GetStream\StreamManager;
use Techinasia\GetStream\Tests\AbstractPackageTestCase;

class StreamTest extends AbstractPackageTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'stream';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Stream::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return StreamManager::class;
    }
}
