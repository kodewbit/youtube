<?php

namespace Kodewbit\YouTube\Exceptions;

use InvalidArgumentException;

class InvalidConfigurationException extends InvalidArgumentException implements ExceptionInterface
{
    /**
     * Missing the API key to use. This key is necessary to make requests to
     * the YouTube API.
     *
     * @return static
     */
    public static function missingApiKey()
    {
        return new static('YouTube API key is required. Please visit https://console.developers.google.com');
    }

    /**
     * Missing application name. To establish the name of the application,
     * it must be done through the ".env" file or through the configuration file.
     *
     * @return static
     */
    public static function missingApplicationName ()
    {
        return new static('Missing application name. Please set one');
    }
}
