<?php

namespace Kodewbit\YouTube;

use Illuminate\Support\ServiceProvider;

class YouTubeServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->getConfigurationFile(), 'youtube');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->getConfigurationFile() => config_path('youtube.php')
            ], 'youtube-config');
        }
    }

    /**
     * Get the package configuration file.
     *
     * @return false|string
     */
    public function getConfigurationFile()
    {
        return realpath($raw = __DIR__ . '/../config/youtube.php') ?: $raw;
    }
}
