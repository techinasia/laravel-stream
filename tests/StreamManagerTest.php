<?php

namespace Techinasia\GetStream\Tests;

use GetStream\Stream\Client;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Techinasia\GetStream\StreamFactory;
use Techinasia\GetStream\StreamManager;

class StreamManagerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->config = Mockery::mock(Repository::class);
        $this->factory = Mockery::mock(StreamFactory::class);

        $this->config
            ->shouldReceive('get')
            ->with('stream.default')
            ->andReturn('main');

        $this->manager = new StreamManager($this->config, $this->factory);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function testApplication()
    {
        $this->mockValidConfig();

        $this->factory
            ->shouldReceive('make')
            ->with([
                'key' => 'foo',
                'name' => 'main',
            ]);

        $this->manager->application();
    }

    /** @expectedException InvalidArgumentException */
    public function testApplicationWithInvalidConfig()
    {
        $this->config
            ->shouldReceive('get')
            ->with('stream.applications')
            ->andReturn([]);

        $this->manager->application();
    }

    /** @test */
    public function testSetDefaultApplication()
    {
        $this->config->shouldReceive('set');
        $this->manager->setDefaultApplication('test');
    }

    /** @test */
    public function testMethodOverloading()
    {
        $this->mockValidConfig();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('foo');

        $this->factory
            ->shouldReceive('make')
            ->andReturn($client);

        $this->manager->foo();
    }

    protected function mockValidConfig()
    {
        $this->config
            ->shouldReceive('get')
            ->with('stream.applications')
            ->andReturn([
                'main' => ['key' => 'foo'],
            ]);
    }
}
