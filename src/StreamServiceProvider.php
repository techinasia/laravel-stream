<?php

namespace Techinasia\GetStream;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class StreamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'stream.factory',
            'stream',
        ];
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('stream.factory', function () {
            return new StreamFactory();
        });

        $this->app->alias('stream.factory', StreamFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('stream', function (Container $app) {
            $config = $app['config'];
            $factory = $app['stream.factory'];

            return new StreamManager($config, $factory);
        });

        $this->app->alias('stream', StreamManager::class);
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/stream.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('stream.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('stream');
        }

        $this->mergeConfigFrom($source, 'stream');
    }
}
