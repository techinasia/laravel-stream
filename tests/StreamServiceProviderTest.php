<?php

namespace Techinasia\GetStream\Tests;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Techinasia\GetStream\StreamFactory;
use Techinasia\GetStream\StreamManager;
use Techinasia\GetStream\StreamServiceProvider;

class StreamServiceProviderTest extends AbstractPackageTestCase
{
    use ServiceProviderTrait;

    /** @test */
    public function testStreamFactoryInjectable()
    {
        $this->assertIsInjectable(StreamFactory::class);
    }

    /** @test */
    public function testStreamManagerInjectable()
    {
        $this->assertIsInjectable(StreamManager::class);
    }

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
