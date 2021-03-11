<?php

namespace Kodewbit\YouTube;

use Illuminate\Support\ServiceProvider;
use Kodewbit\YouTube\Contracts\YouTube as YouTubeInterface;

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

        $this->configureBindings();
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

    /**
     * Register the package's bindings.
     *
     * @return void
     */
    private function configureBindings()
    {
        $this->app->bind(YouTubeInterface::class, YouTube::class);
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
}
