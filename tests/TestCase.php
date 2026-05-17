<?php

namespace Hexatex\LaravelService\Tests;

use Hexatex\LaravelService\LaravelServiceServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase as Orchestra;
use \ReflectionClass;

abstract class TestCase extends Orchestra
{
    use DatabaseMigrations;

    protected function getPackageProviders($app)
    {
        return [
            LaravelServiceServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:jqAF7i3K4aZ+6h/jN/jl9ZQRCn1c3LPGACxe+x7FpBQ=');
    }

    protected function getInaccessibleMethod($class, string $methodName)
    {
        $reflection = new ReflectionClass($class);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Additional setup code, if any
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
