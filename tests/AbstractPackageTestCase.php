<?php

namespace Techinasia\GetStream\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase as BaseAbstractPackageTestCase;
use Techinasia\GetStream\StreamServiceProvider;

abstract class AbstractPackageTestCase extends BaseAbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return StreamServiceProvider::class;
    }
}
