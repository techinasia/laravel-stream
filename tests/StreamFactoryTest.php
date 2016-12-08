<?php

namespace Techinasia\GetStream\Tests;

use GetStream\Stream\Client;
use Mockery;
use Techinasia\GetStream\StreamFactory;

class StreamFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new StreamFactory();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function testMake()
    {
        $config = ['key' => 'foo', 'secret' => 'bar'];
        $client = $this->factory->make($config);

        $this->assertInstanceOf(Client::class, $client);
    }

    /** @expectedException InvalidArgumentException */
    public function testMakeWithMissingKey()
    {
        $config = ['secret' => 'bar'];
        $client = $this->factory->make($config);
    }

    /** @expectedException InvalidArgumentException */
    public function testMakeWithMissingSecret()
    {
        $config = ['key' => 'bar'];
        $client = $this->factory->make($config);
    }

    /** @expectedException InvalidArgumentException */
    public function testMakeWithEmptyConfig()
    {
        $config = [];
        $client = $this->factory->make($config);
    }
}
